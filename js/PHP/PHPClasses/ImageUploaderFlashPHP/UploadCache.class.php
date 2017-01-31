<?php
require_once 'Mutex.class.php';

class UploadCache {

  private $_cacheRoot;
  private $_cacheAliveTimeout;

  /**
   * UploadCache constructor
   * @param UploadSession $uploadSession
   */
  function __construct($cacheRoot, $cacheAliveTimeout) {
    if (!empty($cacheRoot)) {
      $cacheRoot = rtrim($cacheRoot, '/\\');
    }

    if (empty($cacheRoot)) {
      throw new Exception('Cache root directory can not be null.');
    }

    $this->_cacheRoot = $cacheRoot;
    $this->_cacheAliveTimeout = $cacheAliveTimeout;
  }

  /**
   * Get default root upload cache directory.
   */
  public function getCacheRoot() {
    return $this->_cacheRoot;
  }

  public static function moveFile($source, $destination) {
    $result = @rename($source, $destination);
    if (!$result) {
      // copy-remove otherwise
      $result = copy($source, $destination);
      unlink($source);
    }
    return $result;
  }

    /**
     * Remove expired upload sessions
     */
  public function removeExpiredSessions() {
    if (is_dir($this->getCacheRoot())) {
      $lastFullScan = $this->getLastFullScanTimestamp();
      $currentTimestamp = time();

      // Do not scan all cache too often
      if ($currentTimestamp > $lastFullScan + $this->_cacheAliveTimeout / 2) {
        $dirs = scandir($this->getCacheRoot());
        foreach ($dirs as $dir) {
          if ($dir != '.' && $dir != '..' && is_dir($this->getCacheRoot() . DIRECTORY_SEPARATOR . $dir)) {
            $uploadSessionId = $dir;
            if ($this->getWriteTimestamp($uploadSessionId) + $this->_cacheAliveTimeout < $currentTimestamp) {
              $this->cleanCache($uploadSessionId);
            }
          }
        }

        $this->setLastFullScanTimestamp($currentTimestamp);
      }
    }
  }

  public function cleanUploadSessionCache($uploadSessionId) {
    $mutex = new Mutex("uploaderlock3");
    while(!$mutex->getLock()){
      sleep(0.01);
    }

    $this->cleanCache($uploadSessionId);
    
    $mutex->releaseLock();
  }

  private function cleanCache($uploadSessionId) {
    $dir = $this->getSessionCacheDirectory($uploadSessionId);
    if (!empty($dir) && file_exists($dir)) {
      UploadCache::rmdir_recursive($dir);
    }
  }

  public function getLastFullScanTimestamp() {
    $file = $this->getCacheRoot().DIRECTORY_SEPARATOR.'timestamp';
    $timestamp = 0;
    if (is_file($file)) {
      $timestamp = file_get_contents($file);
      $timestamp = @intval($timestamp, 10);
    }
    return $timestamp;
  }


  public function setLastFullScanTimestamp($value = NULL) {
    $file = $this->getCacheRoot().DIRECTORY_SEPARATOR.'timestamp';
    if ($value === NULL) {
      $value = time();
    }
    file_put_contents($file, $value);
  }

  /**
   * Check if package exists in the cache
   * @param $package
   */
  public function isPackageCached($uploadSessionId, $packageIndex) {
    return file_exists($this->getPackageCacheDirectory($uploadSessionId, $packageIndex));
  }

  public function loadSavedFields($uploadSessionId, $packageIndex) {
    $filePath = $this->getPackageCacheDirectory($uploadSessionId, $packageIndex) . DIRECTORY_SEPARATOR . 'post';
    return unserialize(file_get_contents($filePath));
  }

  public function loadSavedFiles($uploadSessionId, $packageIndex) {
    $path = $this->getPackageCacheDirectory($uploadSessionId, $packageIndex) . DIRECTORY_SEPARATOR;
    $items = scandir($path);
    $rg = '#^File\\d+_\\d+$#';
    $files = array();
    foreach ($items as $file) {
      if (preg_match($rg, $file)) {
        $files[$file] = array(
          'cached' => true,
          'tmp_name' => $path . $file,
          'type' => 'application/octet-stream',
          'error' => UPLOAD_ERR_OK,
          'size' => filesize($path . $file)
        );
      }
    }
    return $files;
  }

  /**
   * Save package fields and files into upload temp cache
   * @param Package $package
   */
  public function saveRequestData($uploadSessionId, $packageIndex, $fields, $files) {
    $path = $this->getPackageCacheDirectory($uploadSessionId, $packageIndex);

    $mutex = new Mutex("uploaderlock2");
    while(!$mutex->getLock()){
      sleep(0.01);
    }

    if (!file_exists($path)) {
      mkdir($path, 0777, true);
    }

    $this->saveFields($path, $fields);
    $this->saveFiles($path, $files, $fields);

    $this->setWriteTimestamp($uploadSessionId);

    $mutex->releaseLock();
  }

  private function saveFields($path, $fields) {
    $filePath = $path . DIRECTORY_SEPARATOR . 'post';
    if (file_exists($filePath)) {
      $data = file_get_contents($filePath);
      $data = unserialize($data);
    }
    if (isset($data)) {
      $fields = array_merge($data, $fields);
    }

    file_put_contents($path . DIRECTORY_SEPARATOR . 'post', serialize($fields));
  }

    public function saveCompletedPackagesCount($uploadSessionId){
      $completedPackages = 1;

      $uploadPath = $this->getSessionCacheDirectory($uploadSessionId);
      if (!file_exists($uploadPath)){
        mkdir($uploadPath, 0777, true);
      }
      $this->setWriteTimestamp($uploadSessionId);

      $filename = $uploadPath . DIRECTORY_SEPARATOR . "packages.dat";
      if (file_exists($filename)){
        $completedPackages += unserialize(file_get_contents($filename));
      }
      file_put_contents($filename, serialize($completedPackages));

      return $completedPackages;
    }

    public function isPackageCompleted($uploadSessionId, $packageIndex, $packageRequestCount, &$uploadedPackagesCount){
      $packageDir = $this->getPackageCacheDirectory($uploadSessionId, $packageIndex);
      $filename = $packageDir . DIRECTORY_SEPARATOR . "requests.dat";

      $requests = array("currentRequestCount" => 1, "packageRequestCount" => $packageRequestCount);
      $isCompleted = false;

      $mutex = new Mutex("uploaderlock1");
      while(!$mutex->getLock()){
        sleep(0.01);
      }

      if (file_exists($filename)) {
        $requests = unserialize(file_get_contents($filename));

        $requests["currentRequestCount"]++;
        if ($packageRequestCount != -1){
          $requests["packageRequestCount"] = $packageRequestCount;
        }
      }

      if ($requests["currentRequestCount"] == $requests["packageRequestCount"]){
        $isCompleted = true;
        $uploadedPackagesCount = $this->saveCompletedPackagesCount($uploadSessionId);
      } else {
          file_put_contents($filename, serialize($requests));
      }

      $mutex->releaseLock();

      return $isCompleted;
    }

  private function saveFiles($path, $files, $fields) {
    $rg = '/^File(\d+)_(\d+)$/i';
    foreach ($files as $key => $file) {
      $filePath = $path . DIRECTORY_SEPARATOR . $key;
      $chunkIndex = -1;
      $chunkCount = -1;

      $matches = null;
      if (preg_match($rg, $key, $matches)) {
        $converterIndex = $matches[1];
        $fileIndex = $matches[2];
        $chunkIndex = @$fields[sprintf(PostFields::fileChunkIndex, $converterIndex, $fileIndex)];
        if (!is_null($chunkIndex)){
          $chunkCount = @$fields[sprintf(PostFields::fileChunkCount, $converterIndex, $fileIndex)];
        }
      }

      if ($chunkCount > 1) {
        $tmpFilePath =$filePath . "_tmp";
        if (!file_exists($tmpFilePath)) {
          mkdir($tmpFilePath, 0777, true);
        }
        $tmpFilename = $tmpFilePath . DIRECTORY_SEPARATOR. $chunkIndex;

        $this->saveFile($file, $key, $fields, $tmpFilename);
        if ($chunkCount == count(glob($tmpFilePath . DIRECTORY_SEPARATOR ."[0-9]*"))) {
          $this->mergeFileChunks( $tmpFilePath, $filePath, $chunkCount);
        }
      } else {
        $this->saveFile($file, $key, $fields, $filePath);
      }
    }
  }

  protected function saveFile($file, $filename, $fields, $path){
     if (isset($file['in_request']) && $file['in_request'] === true) {
       $data = $fields[$filename];
       $fdst = fopen($path, 'w');
       fwrite($fdst, $data);
       fclose($fdst);
     } else {
       if (is_uploaded_file($file['tmp_name']) && !file_exists($path)) {
         move_uploaded_file($file['tmp_name'], $path);
       }
     }
  }

  private function mergeFileChunks($srcFilePath, $dstFilePath, $chunkCount) {
    $dstHandle = fopen($dstFilePath, 'a');
    for ($i = 0; $i < $chunkCount; $i++) {
      $chunkFilename = $srcFilePath . DIRECTORY_SEPARATOR . $i;

      $srcHandle = fopen($chunkFilename, "rb");
      fwrite($dstHandle, fread($srcHandle, filesize($chunkFilename)));
      fclose($srcHandle);
    }
    fclose($dstHandle);

    $this->rmdir_recursive($srcFilePath);
  }

  public function getSessionCacheDirectory($uploadSessionId) {
    return $this->getCacheRoot() . DIRECTORY_SEPARATOR . $uploadSessionId;
  }

  public function getPackageCacheDirectory($uploadSessionId, $packageIndex) {
    return $this->getSessionCacheDirectory($uploadSessionId) . DIRECTORY_SEPARATOR . $packageIndex;
  }

  private function setWriteTimestamp($uploadSessionId, $time = NULL) {
    if ($time === NULL) {
      $time = time();
    }

    file_put_contents($this->getSessionCacheDirectory($uploadSessionId).DIRECTORY_SEPARATOR.'timestamp', $time);
  }

  public function getWriteTimestamp($uploadSessionId) {
    $timestampFile = $this->getSessionCacheDirectory($uploadSessionId).DIRECTORY_SEPARATOR.'timestamp';
    $timestamp = -1;
    if (is_file($timestampFile)) {
      $timestamp = file_get_contents($timestampFile);
      $timestamp = @intval($timestamp, 10);
    }

    if ($timestamp <= 0) {
      // If no timestamp file then set current time
      $timestamp = time();
      $this->setWriteTimestamp($uploadSessionId, $timestamp);
    }

    return $timestamp;
  }

  private static function rmdir_recursive($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != '.' && $object != '..') {
          if (is_dir($dir.DIRECTORY_SEPARATOR.$object)) {
            UploadCache::rmdir_recursive($dir.DIRECTORY_SEPARATOR.$object);
          } else {
            unlink($dir.DIRECTORY_SEPARATOR.$object);
          }
        }
      }
      reset($objects);
      rmdir($dir);
    }
  }
}



<?php

require_once 'PostFields.class.php';
require_once 'UploadCache.class.php';
require_once 'Package.class.php';

class UploadSession {

  private $_post = NULL;
  private $_files = NULL;
  private $_server = NULL;
  private $_uploadCache = NULL;

  private $_fileUploadedCallback = NULL;
  private $_allFilesUploadedCallback = NULL;

  public $completedPackagesCount = 0;

  function __construct($uploadCache, $post = NULL, $files = NULL, $server = NULL) {
    if (empty($uploadCache)) {
      throw new Exception('Upload cache can not be null.');
    }
    
    $this->_uploadCache = $uploadCache;
    
    $this->_post = $post === NULL ? $_POST : $post;
    $this->_files = $files === NULL ? $_FILES : $files;
    $this->_server = $server === NULL ? $_SERVER : $server;
  }

  public function processRequest() {
    if (!$this->validateRequest()) {
      return NULL;
    }

    // copy file names from files array to post array
    $this->addFileNames($this->_post, $this->_files);

    $packageIndex = intval($this->_post[PostFields::packageIndex], 10);
    $packageCount = intval($this->_post[PostFields::packageCount], 10);

    // If AllFilesUploaded callback set, then we need to cache package in any case.
    $saveIntoCache = !empty($this->_allFilesUploadedCallback);
    $package = new Package($this, $packageIndex, $saveIntoCache, true);

    if ($package->getCompleted()) {

      if (!empty($this->_fileUploadedCallback)) {
        foreach ($package->getUploadedFiles() as $uploadedFile) {
          call_user_func($this->_fileUploadedCallback, $uploadedFile);
        }
      }

      if (!empty($this->_allFilesUploadedCallback)) {
        // Were all packages uploaded?
        if ($packageCount == $this->completedPackagesCount) {
          $allUploadedFiles = array();
          for ($i = 0; $i < $packageCount; $i++) {
            $p = new Package($this, $i);
            $allUploadedFiles = array_merge($allUploadedFiles, $p->getUploadedFiles());
          }

          call_user_func($this->_allFilesUploadedCallback, $allUploadedFiles);
        }
      }

      // remove temp files
      if ($packageCount == $this->completedPackagesCount) {
        $this->getUploadCache()->cleanUploadSessionCache($this->getUploadSessionId());
        $this->getUploadCache()->removeExpiredSessions(); 
      }
    }
  }

  private function addFileNames(&$fields, &$files) {
    $rg = '/^File(\d+)_(\d+)$/i';
    foreach ($files as $key => $file) {
      $matches = null;
      if (preg_match($rg, $key, $matches)) {
        $converterIndex = $matches[1];
        $fileIndex = $matches[2];
        $fileNameField = sprintf(PostFields::fileName, $converterIndex, $fileIndex);
        if (!isset($fields[$fileNameField])) {
          @$chunkIndex = $fields[sprintf(PostFields::fileChunkIndex, $converterIndex, $fileIndex)];
          if (empty($chunkIndex)) {
            $fields[$fileNameField] = $file['name'];
          }
        }
      }
    }
  }

  public function setFileUploadedCallback($callback) {
    $this->_fileUploadedCallback = $callback;
  }

  public function setAllFilesUploadedCallback($callback) {
    $this->_allFilesUploadedCallback = $callback;
  }

  public function getFileUploadedCallback() {
    return $this->_fileUploadedCallback;
  }

  public function getAllFilesUploadedCallback() {
    return $this->_allFilesUploadedCallback;
  }

  public function getRequestFields() {
    return $this->_post;
  }

  public function getRequestFiles() {
    return $this->_files;
  }

  public function getUploadSessionId() {
    return $this->_post[PostFields::packageGuid];
  }

  /**
   * Get upload cache object for upload session.
   * @return UploadCache
   */
  public function getUploadCache() {
    return $this->_uploadCache;
  }

  private function validateRequest() {
    if (empty($this->_server) || empty($this->_post) || $this->_server['REQUEST_METHOD'] !== 'POST') {
      return false;
    }
     
    // Every request have PackageGuid field
    if (empty($this->_post[PostFields::packageGuid])) {
      // If not - it is not image uploader request, ignore it.
      return false;
    }
     
    // check if request completed
    if (@$this->_post[PostFields::requestComplete] != 1) {
      throw new Exception('Upload request is invalid.');
    }
     
    if (!isset($this->_post[PostFields::packageIndex]) || !isset($this->_post[PostFields::packageCount])) {
      throw new Exception('Upload request is invalid.');
    }
     
    return true;
  }

}
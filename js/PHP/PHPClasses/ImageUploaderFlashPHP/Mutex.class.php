<?php
// sys_get_temp_dir function exists in PHP 5 >= 5.2.1
if ( !function_exists('sys_get_temp_dir')) {
    function sys_get_temp_dir() {
        if ($temp = ini_get('upload_tmp_dir')) {
            return $temp;
        }
        if ($temp = getenv('TMP')) {
            return $temp;
        }
        if ($temp = getenv('TEMP')) {
            return $temp;
        }
        if ($temp = getenv('TMPDIR')){
            return $temp;
        }
        $temp = tempnam(dirname(__FILE__), '');
        if (file_exists($temp)) {
            unlink($temp);
            return dirname($temp);
        }
        return null;
    }
}

class Mutex {
    var $lockPath = '';
    var $fileHandle = null;

    public function __construct($lockName){
        $tmpDir = rtrim(sys_get_temp_dir(), '/\\');
        $this->lockPath = $tmpDir . DIRECTORY_SEPARATOR . preg_replace('/[^a-z0-9]/', '', $lockName);
    }

    public function getLock(){
        return flock($this->getFileHandle(), LOCK_EX);
    }

    public function getFileHandle(){
        if($this->fileHandle == null){
            $this->fileHandle = fopen($this->lockPath, 'c');
        }
        return $this->fileHandle;
    }

    public function releaseLock(){
        $success = flock($this->getFileHandle(), LOCK_UN);
        fclose($this->getFileHandle());
        return $success;
    }

    public function isLocked(){
        $fileHandle = fopen($this->lockPath, 'c');
        $canLock = flock($fileHandle, LOCK_EX);
        if($canLock){
            flock($fileHandle, LOCK_UN);
            fclose($fileHandle);
            return false;
        } else {
            fclose($fileHandle);
            return true;
        }
    }
}
?>
<?php

class Messages {
  public $attributes;

  
	private $_CannotReadFile;
	/**
	* @return string
	*/
	public function getCannotReadFile() {
		if (isset($this->_CannotReadFile))
			return $this->_CannotReadFile;
		else
			return null;
	}
	public function setCannotReadFile($value) {
		$this->_CannotReadFile = $value;
	}
	
	private $_DimensionsTooLarge;
	/**
	* @return string
	*/
	public function getDimensionsTooLarge() {
		if (isset($this->_DimensionsTooLarge))
			return $this->_DimensionsTooLarge;
		else
			return null;
	}
	public function setDimensionsTooLarge($value) {
		$this->_DimensionsTooLarge = $value;
	}
	
	private $_DimensionsTooSmall;
	/**
	* @return string
	*/
	public function getDimensionsTooSmall() {
		if (isset($this->_DimensionsTooSmall))
			return $this->_DimensionsTooSmall;
		else
			return null;
	}
	public function setDimensionsTooSmall($value) {
		$this->_DimensionsTooSmall = $value;
	}
	
	private $_FileNameNotAllowed;
	/**
	* @return string
	*/
	public function getFileNameNotAllowed() {
		if (isset($this->_FileNameNotAllowed))
			return $this->_FileNameNotAllowed;
		else
			return null;
	}
	public function setFileNameNotAllowed($value) {
		$this->_FileNameNotAllowed = $value;
	}
	
	private $_FileSizeTooSmall;
	/**
	* @return string
	*/
	public function getFileSizeTooSmall() {
		if (isset($this->_FileSizeTooSmall))
			return $this->_FileSizeTooSmall;
		else
			return null;
	}
	public function setFileSizeTooSmall($value) {
		$this->_FileSizeTooSmall = $value;
	}
	
	private $_FilesNotAdded;
	/**
	* @return string
	*/
	public function getFilesNotAdded() {
		if (isset($this->_FilesNotAdded))
			return $this->_FilesNotAdded;
		else
			return null;
	}
	public function setFilesNotAdded($value) {
		$this->_FilesNotAdded = $value;
	}
	
	private $_MaxFileCountExceeded;
	/**
	* @return string
	*/
	public function getMaxFileCountExceeded() {
		if (isset($this->_MaxFileCountExceeded))
			return $this->_MaxFileCountExceeded;
		else
			return null;
	}
	public function setMaxFileCountExceeded($value) {
		$this->_MaxFileCountExceeded = $value;
	}
	
	private $_MaxFileSizeExceeded;
	/**
	* @return string
	*/
	public function getMaxFileSizeExceeded() {
		if (isset($this->_MaxFileSizeExceeded))
			return $this->_MaxFileSizeExceeded;
		else
			return null;
	}
	public function setMaxFileSizeExceeded($value) {
		$this->_MaxFileSizeExceeded = $value;
	}
	
	private $_MaxTotalFileSizeExceeded;
	/**
	* @return string
	*/
	public function getMaxTotalFileSizeExceeded() {
		if (isset($this->_MaxTotalFileSizeExceeded))
			return $this->_MaxTotalFileSizeExceeded;
		else
			return null;
	}
	public function setMaxTotalFileSizeExceeded($value) {
		$this->_MaxTotalFileSizeExceeded = $value;
	}
	
	private $_MemoryLimitReached;
	/**
	* @return string
	*/
	public function getMemoryLimitReached() {
		if (isset($this->_MemoryLimitReached))
			return $this->_MemoryLimitReached;
		else
			return null;
	}
	public function setMemoryLimitReached($value) {
		$this->_MemoryLimitReached = $value;
	}
	
	private $_PreviewNotAvailable;
	/**
	* @return string
	*/
	public function getPreviewNotAvailable() {
		if (isset($this->_PreviewNotAvailable))
			return $this->_PreviewNotAvailable;
		else
			return null;
	}
	public function setPreviewNotAvailable($value) {
		$this->_PreviewNotAvailable = $value;
	}
	
	private $_TooFewFiles;
	/**
	* @return string
	*/
	public function getTooFewFiles() {
		if (isset($this->_TooFewFiles))
			return $this->_TooFewFiles;
		else
			return null;
	}
	public function setTooFewFiles($value) {
		$this->_TooFewFiles = $value;
	}
	
	private $_TooManyFilesSelectedToOpen;
	/**
	* @return string
	*/
	public function getTooManyFilesSelectedToOpen() {
		if (isset($this->_TooManyFilesSelectedToOpen))
			return $this->_TooManyFilesSelectedToOpen;
		else
			return null;
	}
	public function setTooManyFilesSelectedToOpen($value) {
		$this->_TooManyFilesSelectedToOpen = $value;
	}
	

  function __construct(){
    
		$this->setCannotReadFile('Cannot read file: {0}.');
		$this->setDimensionsTooLarge('Dimensions of \'{0}\' are too large, the file wasn\'t added. Allowed maximum are {1}x{2} pixels.');
		$this->setDimensionsTooSmall('Dimensions of \'{0}\' are too small, the file wasn\'t added. Allowed minimum are {1}x{2} pixels.');
		$this->setFileNameNotAllowed('The file \'{0}\' cannot be added. The website doesn\'t accept files of this type.');
		$this->setFileSizeTooSmall('Size of \'{0}\' is too small to be added. Minimum allowed size is {1}.');
		$this->setFilesNotAdded('{0} files were not added due to restrictions of the site.');
		$this->setMaxFileCountExceeded('Not all files were added. You allowed to upload no more than {0} file(s).');
		$this->setMaxFileSizeExceeded('Size of \'{0}\' is too large to be added. Maximum allowed size is {1}.');
		$this->setMaxTotalFileSizeExceeded('Not all files were added. Maximum total file size ({0}) was exceeded.');
		$this->setMemoryLimitReached('You selected maximum possible amount of files. Proceed with uploading the current set of files first and then continue selecting files if it is needed.');
		$this->setPreviewNotAvailable('Preview is not available');
		$this->setTooFewFiles('At least {0} files should be selected to start upload.');
		$this->setTooManyFilesSelectedToOpen('Image Uploader Flash is unable to add selected amount of files to upload list at once. Please break the files set into subsets and add them separately.');

    $this->attributes = array();
    
		$this->attributes['CannotReadFile'] = array('jsName' => 'cannotReadFile','jsType' => 'String','defaultValue' => 'Cannot read file: {0}.');
		$this->attributes['DimensionsTooLarge'] = array('jsName' => 'dimensionsTooLarge','jsType' => 'String','defaultValue' => 'Dimensions of \'{0}\' are too large, the file wasn\'t added. Allowed maximum are {1}x{2} pixels.');
		$this->attributes['DimensionsTooSmall'] = array('jsName' => 'dimensionsTooSmall','jsType' => 'String','defaultValue' => 'Dimensions of \'{0}\' are too small, the file wasn\'t added. Allowed minimum are {1}x{2} pixels.');
		$this->attributes['FileNameNotAllowed'] = array('jsName' => 'fileNameNotAllowed','jsType' => 'String','defaultValue' => 'The file \'{0}\' cannot be added. The website doesn\'t accept files of this type.');
		$this->attributes['FileSizeTooSmall'] = array('jsName' => 'fileSizeTooSmall','jsType' => 'String','defaultValue' => 'Size of \'{0}\' is too small to be added. Minimum allowed size is {1}.');
		$this->attributes['FilesNotAdded'] = array('jsName' => 'filesNotAdded','jsType' => 'String','defaultValue' => '{0} files were not added due to restrictions of the site.');
		$this->attributes['MaxFileCountExceeded'] = array('jsName' => 'maxFileCountExceeded','jsType' => 'String','defaultValue' => 'Not all files were added. You allowed to upload no more than {0} file(s).');
		$this->attributes['MaxFileSizeExceeded'] = array('jsName' => 'maxFileSizeExceeded','jsType' => 'String','defaultValue' => 'Size of \'{0}\' is too large to be added. Maximum allowed size is {1}.');
		$this->attributes['MaxTotalFileSizeExceeded'] = array('jsName' => 'maxTotalFileSizeExceeded','jsType' => 'String','defaultValue' => 'Not all files were added. Maximum total file size ({0}) was exceeded.');
		$this->attributes['MemoryLimitReached'] = array('jsName' => 'memoryLimitReached','jsType' => 'String','defaultValue' => 'You selected maximum possible amount of files. Proceed with uploading the current set of files first and then continue selecting files if it is needed.');
		$this->attributes['PreviewNotAvailable'] = array('jsName' => 'previewNotAvailable','jsType' => 'String','defaultValue' => 'Preview is not available');
		$this->attributes['TooFewFiles'] = array('jsName' => 'tooFewFiles','jsType' => 'String','defaultValue' => 'At least {0} files should be selected to start upload.');
		$this->attributes['TooManyFilesSelectedToOpen'] = array('jsName' => 'tooManyFilesSelectedToOpen','jsType' => 'String','defaultValue' => 'Image Uploader Flash is unable to add selected amount of files to upload list at once. Please break the files set into subsets and add them separately.');
  }

}
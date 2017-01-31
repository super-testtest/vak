<?php

class StatusPane {
  public $attributes;

  
	private $_DataUploadedText;
	/**
	* @return string
	*/
	public function getDataUploadedText() {
		if (isset($this->_DataUploadedText))
			return $this->_DataUploadedText;
		else
			return null;
	}
	public function setDataUploadedText($value) {
		$this->_DataUploadedText = $value;
	}
	
	private $_FilesPreparedText;
	/**
	* @return string
	*/
	public function getFilesPreparedText() {
		if (isset($this->_FilesPreparedText))
			return $this->_FilesPreparedText;
		else
			return null;
	}
	public function setFilesPreparedText($value) {
		$this->_FilesPreparedText = $value;
	}
	
	private $_FilesToUploadText;
	/**
	* @return string
	*/
	public function getFilesToUploadText() {
		if (isset($this->_FilesToUploadText))
			return $this->_FilesToUploadText;
		else
			return null;
	}
	public function setFilesToUploadText($value) {
		$this->_FilesToUploadText = $value;
	}
	
	private $_FilesUploadedText;
	/**
	* @return string
	*/
	public function getFilesUploadedText() {
		if (isset($this->_FilesUploadedText))
			return $this->_FilesUploadedText;
		else
			return null;
	}
	public function setFilesUploadedText($value) {
		$this->_FilesUploadedText = $value;
	}
	
	private $_NoFilesToUploadText;
	/**
	* @return string
	*/
	public function getNoFilesToUploadText() {
		if (isset($this->_NoFilesToUploadText))
			return $this->_NoFilesToUploadText;
		else
			return null;
	}
	public function setNoFilesToUploadText($value) {
		$this->_NoFilesToUploadText = $value;
	}
	
	private $_PreparingText;
	/**
	* @return string
	*/
	public function getPreparingText() {
		if (isset($this->_PreparingText))
			return $this->_PreparingText;
		else
			return null;
	}
	public function setPreparingText($value) {
		$this->_PreparingText = $value;
	}
	
	private $_SendingText;
	/**
	* @return string
	*/
	public function getSendingText() {
		if (isset($this->_SendingText))
			return $this->_SendingText;
		else
			return null;
	}
	public function setSendingText($value) {
		$this->_SendingText = $value;
	}
	

  function __construct(){
    
		$this->setDataUploadedText('Data uploaded: {0} / {1}');
		$this->setFilesPreparedText('Files prepared: {0} / {1}');
		$this->setFilesToUploadText('<font color=\'#7a7a7a\'>Total files:</font> {0}');
		$this->setFilesUploadedText('Files complete: {0} / {1}');
		$this->setNoFilesToUploadText('No files to upload');
		$this->setPreparingText('PREPARING...');
		$this->setSendingText('UPLOADING...');

    $this->attributes = array();
    
		$this->attributes['DataUploadedText'] = array('jsName' => 'dataUploadedText','jsType' => 'String','defaultValue' => 'Data uploaded: {0} / {1}');
		$this->attributes['FilesPreparedText'] = array('jsName' => 'filesPreparedText','jsType' => 'String','defaultValue' => 'Files prepared: {0} / {1}');
		$this->attributes['FilesToUploadText'] = array('jsName' => 'filesToUploadText','jsType' => 'String','defaultValue' => '<font color=\'#7a7a7a\'>Total files:</font> {0}');
		$this->attributes['FilesUploadedText'] = array('jsName' => 'filesUploadedText','jsType' => 'String','defaultValue' => 'Files complete: {0} / {1}');
		$this->attributes['NoFilesToUploadText'] = array('jsName' => 'noFilesToUploadText','jsType' => 'String','defaultValue' => 'No files to upload');
		$this->attributes['PreparingText'] = array('jsName' => 'preparingText','jsType' => 'String','defaultValue' => 'PREPARING...');
		$this->attributes['SendingText'] = array('jsName' => 'sendingText','jsType' => 'String','defaultValue' => 'UPLOADING...');
  }

}
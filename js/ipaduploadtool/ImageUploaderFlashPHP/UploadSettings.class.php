<?php

class UploadSettings {
  public $attributes;

  
	private $_ActionUrl;
	/**
	* @return string
	*/
	public function getActionUrl() {
		if (isset($this->_ActionUrl))
			return $this->_ActionUrl;
		else
			return null;
	}
	public function setActionUrl($value) {
		$this->_ActionUrl = $value;
	}
	
	private $_ChunkSize;
	/**
	* @return integer
	*/
	public function getChunkSize() {
		if (isset($this->_ChunkSize))
			return $this->_ChunkSize;
		else
			return null;
	}
	public function setChunkSize($value) {
		$this->_ChunkSize = $value;
	}
	
	private $_ProgressBytesMode;
	/**
	* @return string
	*/
	public function getProgressBytesMode() {
		if (isset($this->_ProgressBytesMode))
			return $this->_ProgressBytesMode;
		else
			return null;
	}
	public function setProgressBytesMode($value) {
		$this->_ProgressBytesMode = $value;
	}
	
	private $_RedirectUrl;
	/**
	* @return string
	*/
	public function getRedirectUrl() {
		if (isset($this->_RedirectUrl))
			return $this->_RedirectUrl;
		else
			return null;
	}
	public function setRedirectUrl($value) {
		$this->_RedirectUrl = $value;
	}
	

  function __construct(){
    
		$this->setActionUrl('.');
		$this->setChunkSize(0);
		$this->setProgressBytesMode('ByPackageSize');

    $this->attributes = array();
    
		$this->attributes['ActionUrl'] = array('jsName' => 'actionUrl','jsType' => 'String','defaultValue' => '.');
		$this->attributes['ChunkSize'] = array('jsName' => 'chunkSize','jsType' => 'Number','defaultValue' => 0);
		$this->attributes['ProgressBytesMode'] = array('jsName' => 'progressBytesMode','jsType' => 'String','defaultValue' => 'ByPackageSize');
		$this->attributes['RedirectUrl'] = array('jsName' => 'redirectUrl','jsType' => 'String','defaultValue' => '');
  }

}
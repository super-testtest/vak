<?php

class UploadErrorDialog {
  public $attributes;

  
	private $_Title;
	/**
	* @return string
	*/
	public function getTitle() {
		if (isset($this->_Title))
			return $this->_Title;
		else
			return null;
	}
	public function setTitle($value) {
		$this->_Title = $value;
	}
	
	private $_Message;
	/**
	* @return string
	*/
	public function getMessage() {
		if (isset($this->_Message))
			return $this->_Message;
		else
			return null;
	}
	public function setMessage($value) {
		$this->_Message = $value;
	}
	
	private $_ShowDetailsButtonText;
	/**
	* @return string
	*/
	public function getShowDetailsButtonText() {
		if (isset($this->_ShowDetailsButtonText))
			return $this->_ShowDetailsButtonText;
		else
			return null;
	}
	public function setShowDetailsButtonText($value) {
		$this->_ShowDetailsButtonText = $value;
	}
	
	private $_HideDetailsButtonText;
	/**
	* @return string
	*/
	public function getHideDetailsButtonText() {
		if (isset($this->_HideDetailsButtonText))
			return $this->_HideDetailsButtonText;
		else
			return null;
	}
	public function setHideDetailsButtonText($value) {
		$this->_HideDetailsButtonText = $value;
	}
	

  function __construct(){
    
		$this->setTitle('Upload Error');
		$this->setMessage('Not all files were uploaded successfully. If you see this message, contact web master.');
		$this->setShowDetailsButtonText('Show Details');
		$this->setHideDetailsButtonText('Hide Details');

    $this->attributes = array();
    
		$this->attributes['Title'] = array('jsName' => 'title','jsType' => 'String','defaultValue' => 'Upload Error');
		$this->attributes['Message'] = array('jsName' => 'message','jsType' => 'String','defaultValue' => 'Not all files were uploaded successfully. If you see this message, contact web master.');
		$this->attributes['ShowDetailsButtonText'] = array('jsName' => 'showDetailsButtonText','jsType' => 'String','defaultValue' => 'Show Details');
		$this->attributes['HideDetailsButtonText'] = array('jsName' => 'hideDetailsButtonText','jsType' => 'String','defaultValue' => 'Hide Details');
  }

}
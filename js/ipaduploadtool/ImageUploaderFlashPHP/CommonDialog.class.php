<?php

class CommonDialog {
  public $attributes;

  
	private $_OkButtonText;
	/**
	* @return string
	*/
	public function getOkButtonText() {
		if (isset($this->_OkButtonText))
			return $this->_OkButtonText;
		else
			return null;
	}
	public function setOkButtonText($value) {
		$this->_OkButtonText = $value;
	}
	
	private $_CancelButtonText;
	/**
	* @return string
	*/
	public function getCancelButtonText() {
		if (isset($this->_CancelButtonText))
			return $this->_CancelButtonText;
		else
			return null;
	}
	public function setCancelButtonText($value) {
		$this->_CancelButtonText = $value;
	}
	

  function __construct(){
    
		$this->setOkButtonText('OK');
		$this->setCancelButtonText('Cancel');

    $this->attributes = array();
    
		$this->attributes['OkButtonText'] = array('jsName' => 'okButtonText','jsType' => 'String','defaultValue' => 'OK');
		$this->attributes['CancelButtonText'] = array('jsName' => 'cancelButtonText','jsType' => 'String','defaultValue' => 'Cancel');
  }

}
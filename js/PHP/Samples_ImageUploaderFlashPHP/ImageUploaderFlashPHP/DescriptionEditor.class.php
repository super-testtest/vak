<?php

class DescriptionEditor {
  public $attributes;

  
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
	
	private $_SaveButtonText;
	/**
	* @return string
	*/
	public function getSaveButtonText() {
		if (isset($this->_SaveButtonText))
			return $this->_SaveButtonText;
		else
			return null;
	}
	public function setSaveButtonText($value) {
		$this->_SaveButtonText = $value;
	}
	

  function __construct(){
    
		$this->setCancelButtonText('Cancel');
		$this->setSaveButtonText('Save');

    $this->attributes = array();
    
		$this->attributes['CancelButtonText'] = array('jsName' => 'cancelButtonText','jsType' => 'String','defaultValue' => 'Cancel');
		$this->attributes['SaveButtonText'] = array('jsName' => 'saveButtonText','jsType' => 'String','defaultValue' => 'Save');
  }

}
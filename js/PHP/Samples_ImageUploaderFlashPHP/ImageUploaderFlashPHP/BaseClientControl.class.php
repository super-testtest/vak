<?php

require_once "UploaderUtils.class.php";

abstract class BaseClientControl {
  public $attributes;

  
	private $_CodeBase;
	/**
	* @return string
	*/
	public function getCodeBase() {
		if (isset($this->_CodeBase))
			return $this->_CodeBase;
		else
			return null;
	}
	public function setCodeBase($value) {
		$this->_CodeBase = $value;
	}
	

  function __construct(){
    

    $this->attributes = array();
    
  }

}
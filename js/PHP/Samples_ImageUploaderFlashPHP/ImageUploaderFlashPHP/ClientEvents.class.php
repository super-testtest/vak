<?php

class ClientEvents {
  public $attributes;

  
	private $_InitComplete;
	/**
	* @return array
	*/
	public function &getInitComplete() {
		return $this->_InitComplete;
	}
	public function setInitComplete($value) {
		if (is_array($value)) {
			$this->_InitComplete = $value;
		} else {
			$this->_InitComplete = array($value);
		}
	}
	
	private $_BeforeUpload;
	/**
	* @return array
	*/
	public function &getBeforeUpload() {
		return $this->_BeforeUpload;
	}
	public function setBeforeUpload($value) {
		if (is_array($value)) {
			$this->_BeforeUpload = $value;
		} else {
			$this->_BeforeUpload = array($value);
		}
	}
	
	private $_AfterUpload;
	/**
	* @return array
	*/
	public function &getAfterUpload() {
		return $this->_AfterUpload;
	}
	public function setAfterUpload($value) {
		if (is_array($value)) {
			$this->_AfterUpload = $value;
		} else {
			$this->_AfterUpload = array($value);
		}
	}
	
	private $_BeforePackageUpload;
	/**
	* @return array
	*/
	public function &getBeforePackageUpload() {
		return $this->_BeforePackageUpload;
	}
	public function setBeforePackageUpload($value) {
		if (is_array($value)) {
			$this->_BeforePackageUpload = $value;
		} else {
			$this->_BeforePackageUpload = array($value);
		}
	}
	
	private $_AfterPackageUpload;
	/**
	* @return array
	*/
	public function &getAfterPackageUpload() {
		return $this->_AfterPackageUpload;
	}
	public function setAfterPackageUpload($value) {
		if (is_array($value)) {
			$this->_AfterPackageUpload = $value;
		} else {
			$this->_AfterPackageUpload = array($value);
		}
	}
	
	private $_PreRender;
	/**
	* @return array
	*/
	public function &getPreRender() {
		return $this->_PreRender;
	}
	public function setPreRender($value) {
		if (is_array($value)) {
			$this->_PreRender = $value;
		} else {
			$this->_PreRender = array($value);
		}
	}
	
	private $_Progress;
	/**
	* @return array
	*/
	public function &getProgress() {
		return $this->_Progress;
	}
	public function setProgress($value) {
		if (is_array($value)) {
			$this->_Progress = $value;
		} else {
			$this->_Progress = array($value);
		}
	}
	
	private $_Error;
	/**
	* @return array
	*/
	public function &getError() {
		return $this->_Error;
	}
	public function setError($value) {
		if (is_array($value)) {
			$this->_Error = $value;
		} else {
			$this->_Error = array($value);
		}
	}
	
	private $_RestrictionFailed;
	/**
	* @return array
	*/
	public function &getRestrictionFailed() {
		return $this->_RestrictionFailed;
	}
	public function setRestrictionFailed($value) {
		if (is_array($value)) {
			$this->_RestrictionFailed = $value;
		} else {
			$this->_RestrictionFailed = array($value);
		}
	}
	
	private $_Trace;
	/**
	* @return array
	*/
	public function &getTrace() {
		return $this->_Trace;
	}
	public function setTrace($value) {
		if (is_array($value)) {
			$this->_Trace = $value;
		} else {
			$this->_Trace = array($value);
		}
	}
	

  function __construct(){
    

    $this->attributes = array();
    
		$this->attributes['InitComplete'] = array('jsName' => 'initComplete','jsType' => 'event');
		$this->attributes['BeforeUpload'] = array('jsName' => 'beforeUpload','jsType' => 'event');
		$this->attributes['AfterUpload'] = array('jsName' => 'afterUpload','jsType' => 'event');
		$this->attributes['BeforePackageUpload'] = array('jsName' => 'beforePackageUpload','jsType' => 'event');
		$this->attributes['AfterPackageUpload'] = array('jsName' => 'afterPackageUpload','jsType' => 'event');
		$this->attributes['PreRender'] = array('jsName' => 'preRender','jsType' => 'event');
		$this->attributes['Progress'] = array('jsName' => 'progress','jsType' => 'event');
		$this->attributes['Error'] = array('jsName' => 'error','jsType' => 'event');
		$this->attributes['RestrictionFailed'] = array('jsName' => 'restrictionFailed','jsType' => 'event');
		$this->attributes['Trace'] = array('jsName' => 'trace','jsType' => 'event');
  }

}
<?php

class ImagePreviewWindow {
  public $attributes;

  
	private $_ClosePreviewTooltip;
	/**
	* @return string
	*/
	public function getClosePreviewTooltip() {
		if (isset($this->_ClosePreviewTooltip))
			return $this->_ClosePreviewTooltip;
		else
			return null;
	}
	public function setClosePreviewTooltip($value) {
		$this->_ClosePreviewTooltip = $value;
	}
	

  function __construct(){
    
		$this->setClosePreviewTooltip('Click to close');

    $this->attributes = array();
    
		$this->attributes['ClosePreviewTooltip'] = array('jsName' => 'closePreviewTooltip','jsType' => 'String','defaultValue' => 'Click to close');
  }

}
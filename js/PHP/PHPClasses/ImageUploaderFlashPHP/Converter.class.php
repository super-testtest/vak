<?php

class Converter {
  public $attributes;

  
	private $_Mode;
	/**
	* @return string
	*/
	public function getMode() {
		if (isset($this->_Mode))
			return $this->_Mode;
		else
			return null;
	}
	public function setMode($value) {
		$this->_Mode = $value;
	}
	
	private $_ThumbnailBgColor;
	/**
	* @return string
	*/
	public function getThumbnailBgColor() {
		if (isset($this->_ThumbnailBgColor))
			return $this->_ThumbnailBgColor;
		else
			return null;
	}
	public function setThumbnailBgColor($value) {
		$this->_ThumbnailBgColor = $value;
	}
	
	private $_ThumbnailCopyExif;
	/**
	* @return boolean
	*/
	public function getThumbnailCopyExif() {
		if (isset($this->_ThumbnailCopyExif))
			return $this->_ThumbnailCopyExif;
		else
			return null;
	}
	public function setThumbnailCopyExif($value) {
		$this->_ThumbnailCopyExif = $value;
	}
	
	private $_ThumbnailCopyIptc;
	/**
	* @return boolean
	*/
	public function getThumbnailCopyIptc() {
		if (isset($this->_ThumbnailCopyIptc))
			return $this->_ThumbnailCopyIptc;
		else
			return null;
	}
	public function setThumbnailCopyIptc($value) {
		$this->_ThumbnailCopyIptc = $value;
	}
	
	private $_ThumbnailFitMode;
	/**
	* @return string
	*/
	public function getThumbnailFitMode() {
		if (isset($this->_ThumbnailFitMode))
			return $this->_ThumbnailFitMode;
		else
			return null;
	}
	public function setThumbnailFitMode($value) {
		$this->_ThumbnailFitMode = $value;
	}
	
	private $_ThumbnailHeight;
	/**
	* @return integer
	*/
	public function getThumbnailHeight() {
		if (isset($this->_ThumbnailHeight))
			return $this->_ThumbnailHeight;
		else
			return null;
	}
	public function setThumbnailHeight($value) {
		$this->_ThumbnailHeight = $value;
	}
	
	private $_ThumbnailJpegQuality;
	/**
	* @return integer
	*/
	public function getThumbnailJpegQuality() {
		if (isset($this->_ThumbnailJpegQuality))
			return $this->_ThumbnailJpegQuality;
		else
			return null;
	}
	public function setThumbnailJpegQuality($value) {
		$this->_ThumbnailJpegQuality = $value;
	}
	
	private $_ThumbnailWatermark;
	/**
	* @return string
	*/
	public function getThumbnailWatermark() {
		if (isset($this->_ThumbnailWatermark))
			return $this->_ThumbnailWatermark;
		else
			return null;
	}
	public function setThumbnailWatermark($value) {
		$this->_ThumbnailWatermark = $value;
	}
	
	private $_ThumbnailWidth;
	/**
	* @return integer
	*/
	public function getThumbnailWidth() {
		if (isset($this->_ThumbnailWidth))
			return $this->_ThumbnailWidth;
		else
			return null;
	}
	public function setThumbnailWidth($value) {
		$this->_ThumbnailWidth = $value;
	}
	

  function __construct(){
    
		$this->setMode('*.*=SourceFile');
		$this->setThumbnailBgColor('0xffffff');
		$this->setThumbnailCopyExif(false);
		$this->setThumbnailCopyIptc(false);
		$this->setThumbnailFitMode('Fit');
		$this->setThumbnailHeight(96);
		$this->setThumbnailJpegQuality(90);
		$this->setThumbnailWidth(96);

    $this->attributes = array();
    
		$this->attributes['Mode'] = array('jsName' => 'mode','jsType' => 'String','defaultValue' => '*.*=SourceFile');
		$this->attributes['ThumbnailBgColor'] = array('jsName' => 'thumbnailBgColor','jsType' => 'Number','defaultValue' => 0xffffff);
		$this->attributes['ThumbnailCopyExif'] = array('jsName' => 'thumbnailCopyExif','jsType' => 'Boolean','defaultValue' => false);
		$this->attributes['ThumbnailCopyIptc'] = array('jsName' => 'thumbnailCopyIptc','jsType' => 'Boolean','defaultValue' => false);
		$this->attributes['ThumbnailFitMode'] = array('jsName' => 'thumbnailFitMode','jsType' => 'String','defaultValue' => 'Fit');
		$this->attributes['ThumbnailHeight'] = array('jsName' => 'thumbnailHeight','jsType' => 'Number','defaultValue' => 96);
		$this->attributes['ThumbnailJpegQuality'] = array('jsName' => 'thumbnailJpegQuality','jsType' => 'Number','defaultValue' => 90);
		$this->attributes['ThumbnailWatermark'] = array('jsName' => 'thumbnailWatermark','jsType' => 'String','defaultValue' => '');
		$this->attributes['ThumbnailWidth'] = array('jsName' => 'thumbnailWidth','jsType' => 'Number','defaultValue' => 96);
  }

}
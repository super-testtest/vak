<?php

class PaneItem {
  public $attributes;

  
	private $_DescriptionEditorIconTooltip;
	/**
	* @return string
	*/
	public function getDescriptionEditorIconTooltip() {
		if (isset($this->_DescriptionEditorIconTooltip))
			return $this->_DescriptionEditorIconTooltip;
		else
			return null;
	}
	public function setDescriptionEditorIconTooltip($value) {
		$this->_DescriptionEditorIconTooltip = $value;
	}
	
	private $_EnableDisproportionalExifThumbnails;
	/**
	* @return boolean
	*/
	public function getEnableDisproportionalExifThumbnails() {
		if (isset($this->_EnableDisproportionalExifThumbnails))
			return $this->_EnableDisproportionalExifThumbnails;
		else
			return null;
	}
	public function setEnableDisproportionalExifThumbnails($value) {
		$this->_EnableDisproportionalExifThumbnails = $value;
	}
	
	private $_ImageTooltip;
	/**
	* @return string
	*/
	public function getImageTooltip() {
		if (isset($this->_ImageTooltip))
			return $this->_ImageTooltip;
		else
			return null;
	}
	public function setImageTooltip($value) {
		$this->_ImageTooltip = $value;
	}
	
	private $_ItemTooltip;
	/**
	* @return string
	*/
	public function getItemTooltip() {
		if (isset($this->_ItemTooltip))
			return $this->_ItemTooltip;
		else
			return null;
	}
	public function setItemTooltip($value) {
		$this->_ItemTooltip = $value;
	}
	
	private $_RemovalIconTooltip;
	/**
	* @return string
	*/
	public function getRemovalIconTooltip() {
		if (isset($this->_RemovalIconTooltip))
			return $this->_RemovalIconTooltip;
		else
			return null;
	}
	public function setRemovalIconTooltip($value) {
		$this->_RemovalIconTooltip = $value;
	}
	
	private $_RotationIconTooltip;
	/**
	* @return string
	*/
	public function getRotationIconTooltip() {
		if (isset($this->_RotationIconTooltip))
			return $this->_RotationIconTooltip;
		else
			return null;
	}
	public function setRotationIconTooltip($value) {
		$this->_RotationIconTooltip = $value;
	}
	
	private $_ToolbarAlwaysVisible;
	/**
	* @return boolean
	*/
	public function getToolbarAlwaysVisible() {
		if (isset($this->_ToolbarAlwaysVisible))
			return $this->_ToolbarAlwaysVisible;
		else
			return null;
	}
	public function setToolbarAlwaysVisible($value) {
		$this->_ToolbarAlwaysVisible = $value;
	}
	

  function __construct(){
    
		$this->setDescriptionEditorIconTooltip('Edit description');
		$this->setEnableDisproportionalExifThumbnails(true);
		$this->setImageTooltip('{0}\n{1}, {3}, \nModified: {2}');
		$this->setItemTooltip('{0}\n{1}, \nModified: {2}');
		$this->setRemovalIconTooltip('Remove');
		$this->setRotationIconTooltip('Rotate');
		$this->setToolbarAlwaysVisible(false);

    $this->attributes = array();
    
		$this->attributes['DescriptionEditorIconTooltip'] = array('jsName' => 'descriptionEditorIconTooltip','jsType' => 'String','defaultValue' => 'Edit description');
		$this->attributes['EnableDisproportionalExifThumbnails'] = array('jsName' => 'enableDisproportionalExifThumbnails','jsType' => 'Boolean','defaultValue' => true);
		$this->attributes['ImageTooltip'] = array('jsName' => 'imageTooltip','jsType' => 'String','defaultValue' => '{0}\n{1}, {3}, \nModified: {2}');
		$this->attributes['ItemTooltip'] = array('jsName' => 'itemTooltip','jsType' => 'String','defaultValue' => '{0}\n{1}, \nModified: {2}');
		$this->attributes['RemovalIconTooltip'] = array('jsName' => 'removalIconTooltip','jsType' => 'String','defaultValue' => 'Remove');
		$this->attributes['RotationIconTooltip'] = array('jsName' => 'rotationIconTooltip','jsType' => 'String','defaultValue' => 'Rotate');
		$this->attributes['ToolbarAlwaysVisible'] = array('jsName' => 'toolbarAlwaysVisible','jsType' => 'Boolean','defaultValue' => false);
  }

}
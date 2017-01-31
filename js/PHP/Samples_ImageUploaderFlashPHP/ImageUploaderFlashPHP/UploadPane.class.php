<?php

class UploadPane {
  public $attributes;

  
	private $_IconSize;
	/**
	* @return integer
	*/
	public function getIconSize() {
		if (isset($this->_IconSize))
			return $this->_IconSize;
		else
			return null;
	}
	public function setIconSize($value) {
		$this->_IconSize = $value;
	}
	
	private $_TilePreviewSize;
	/**
	* @return integer
	*/
	public function getTilePreviewSize() {
		if (isset($this->_TilePreviewSize))
			return $this->_TilePreviewSize;
		else
			return null;
	}
	public function setTilePreviewSize($value) {
		$this->_TilePreviewSize = $value;
	}
	
	private $_ThumbnailPreviewSize;
	/**
	* @return integer
	*/
	public function getThumbnailPreviewSize() {
		if (isset($this->_ThumbnailPreviewSize))
			return $this->_ThumbnailPreviewSize;
		else
			return null;
	}
	public function setThumbnailPreviewSize($value) {
		$this->_ThumbnailPreviewSize = $value;
	}
	
	private $_TileItemWidth;
	/**
	* @return integer
	*/
	public function getTileItemWidth() {
		if (isset($this->_TileItemWidth))
			return $this->_TileItemWidth;
		else
			return null;
	}
	public function setTileItemWidth($value) {
		$this->_TileItemWidth = $value;
	}
	
	private $_IconItemWidth;
	/**
	* @return integer
	*/
	public function getIconItemWidth() {
		if (isset($this->_IconItemWidth))
			return $this->_IconItemWidth;
		else
			return null;
	}
	public function setIconItemWidth($value) {
		$this->_IconItemWidth = $value;
	}
	
	private $_AddFilesButtonText;
	/**
	* @return string
	*/
	public function getAddFilesButtonText() {
		if (isset($this->_AddFilesButtonText))
			return $this->_AddFilesButtonText;
		else
			return null;
	}
	public function setAddFilesButtonText($value) {
		$this->_AddFilesButtonText = $value;
	}
	
	private $_ViewMode;
	/**
	* @return string
	*/
	public function getViewMode() {
		if (isset($this->_ViewMode))
			return $this->_ViewMode;
		else
			return null;
	}
	public function setViewMode($value) {
		$this->_ViewMode = $value;
	}
	
	// private $_MaxFileCount;

	// public function getMaxFileCount() {
	// 	if (isset($this->_MaxFileCount))
	// 		return $this->_MaxFileCount;
	// 	else
	// 		return null;
	// }
	// public function setMaxFileCount($value) {
	// 	$this->_MaxFileCount = $value;
	// }

  function __construct(){
    
		$this->setIconSize(20);
		$this->setTilePreviewSize(100);
		$this->setThumbnailPreviewSize(115);
		$this->setTileItemWidth(315);
		$this->setIconItemWidth(210);
		$this->setAddFilesButtonText('+ Add file');
		$this->setViewMode('Tiles');


    $this->attributes = array();
    
		$this->attributes['IconSize'] = array('jsName' => 'iconSize','jsType' => 'Number','defaultValue' => 20);
		$this->attributes['TilePreviewSize'] = array('jsName' => 'tilePreviewSize','jsType' => 'Number','defaultValue' => 100);
		$this->attributes['ThumbnailPreviewSize'] = array('jsName' => 'thumbnailPreviewSize','jsType' => 'Number','defaultValue' => 115);
		$this->attributes['TileItemWidth'] = array('jsName' => 'tileItemWidth','jsType' => 'Number','defaultValue' => 315);
		$this->attributes['IconItemWidth'] = array('jsName' => 'iconItemWidth','jsType' => 'Number','defaultValue' => 210);
		$this->attributes['AddFilesButtonText'] = array('jsName' => 'addFilesButtonText','jsType' => 'String','defaultValue' => '+ Add more files');
		$this->attributes['ViewMode'] = array('jsName' => 'viewMode','jsType' => 'String','defaultValue' => 'Tiles');
		//$this->attributes['MaxFileCount'] = array('jsName' => 'maxFileCount','jsType' => 'Number','defaultValue' => 1);
  }

}
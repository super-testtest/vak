<?php

class TopPane {
  public $attributes;

  
	private $_AddFilesHyperlinkText;
	/**
	* @return string
	*/
	public function getAddFilesHyperlinkText() {
		if (isset($this->_AddFilesHyperlinkText))
			return $this->_AddFilesHyperlinkText;
		else
			return null;
	}
	public function setAddFilesHyperlinkText($value) {
		$this->_AddFilesHyperlinkText = $value;
	}
	
	private $_ClearAllHyperlinkText;
	/**
	* @return string
	*/
	public function getClearAllHyperlinkText() {
		if (isset($this->_ClearAllHyperlinkText))
			return $this->_ClearAllHyperlinkText;
		else
			return null;
	}
	public function setClearAllHyperlinkText($value) {
		$this->_ClearAllHyperlinkText = $value;
	}
	
	private $_ShowViewComboBox;
	/**
	* @return boolean
	*/
	public function getShowViewComboBox() {
		if (isset($this->_ShowViewComboBox))
			return $this->_ShowViewComboBox;
		else
			return null;
	}
	public function setShowViewComboBox($value) {
		$this->_ShowViewComboBox = $value;
	}
	
	private $_OrText;
	/**
	* @return string
	*/
	public function getOrText() {
		if (isset($this->_OrText))
			return $this->_OrText;
		else
			return null;
	}
	public function setOrText($value) {
		$this->_OrText = $value;
	}
	
	private $_ViewComboBox;
	/**
	* @return string
	*/
	public function getViewComboBox() {
		if (isset($this->_ViewComboBox))
			return $this->_ViewComboBox;
		else
			return null;
	}
	public function setViewComboBox($value) {
		$this->_ViewComboBox = $value;
	}
	
	private $_ViewComboBoxText;
	/**
	* @return string
	*/
	public function getViewComboBoxText() {
		if (isset($this->_ViewComboBoxText))
			return $this->_ViewComboBoxText;
		else
			return null;
	}
	public function setViewComboBoxText($value) {
		$this->_ViewComboBoxText = $value;
	}
	
	private $_TitleText;
	/**
	* @return string
	*/
	public function getTitleText() {
		if (isset($this->_TitleText))
			return $this->_TitleText;
		else
			return null;
	}
	public function setTitleText($value) {
		$this->_TitleText = $value;
	}
	

  function __construct(){
    
		$this->setAddFilesHyperlinkText('Add more files');
		$this->setClearAllHyperlinkText('remove all files');
		$this->setShowViewComboBox(true);
		$this->setOrText('or');
		$this->setViewComboBox('[\'Tiles\', \'Thumbnails\', \'Icons\']');
		$this->setViewComboBoxText('Change view:');
		$this->setTitleText('Files for upload');

    $this->attributes = array();
    
		$this->attributes['AddFilesHyperlinkText'] = array('jsName' => 'addFilesHyperlinkText','jsType' => 'String','defaultValue' => 'Add more files');
		$this->attributes['ClearAllHyperlinkText'] = array('jsName' => 'clearAllHyperlinkText','jsType' => 'String','defaultValue' => 'remove all files');
		$this->attributes['ShowViewComboBox'] = array('jsName' => 'showViewComboBox','jsType' => 'Boolean','defaultValue' => true);
		$this->attributes['OrText'] = array('jsName' => 'orText','jsType' => 'String','defaultValue' => 'or');
		$this->attributes['ViewComboBox'] = array('jsName' => 'viewComboBox','jsType' => 'Array','defaultValue' => '[\'Tiles\', \'Thumbnails\', \'Icons\']');
		$this->attributes['ViewComboBoxText'] = array('jsName' => 'viewComboBoxText','jsType' => 'String','defaultValue' => 'Change view:');
		$this->attributes['TitleText'] = array('jsName' => 'titleText','jsType' => 'String','defaultValue' => 'Files for upload');
  }

}
<?php

require_once ("BaseClientControl.class.php");

class FlashControl extends BaseClientControl
{
  
	private $_ThemeUrl;
	/**
	* @return string
	*/
	public function getThemeUrl() {
		if (isset($this->_ThemeUrl))
			return $this->_ThemeUrl;
		else
			return null;
	}
	public function setThemeUrl($value) {
		$this->_ThemeUrl = $value;
	}
	
	private $_BgColor;
	/**
	* @return string
	*/
	public function getBgColor() {
		if (isset($this->_BgColor))
			return $this->_BgColor;
		else
			return null;
	}
	public function setBgColor($value) {
		$this->_BgColor = $value;
	}
	
	private $_Wmode;
	/**
	* @return string
	*/
	public function getWmode() {
		if (isset($this->_Wmode))
			return $this->_Wmode;
		else
			return null;
	}
	public function setWmode($value) {
		$this->_Wmode = $value;
	}
	
	private $_Quality;
	/**
	* @return string
	*/
	public function getQuality() {
		if (isset($this->_Quality))
			return $this->_Quality;
		else
			return null;
	}
	public function setQuality($value) {
		$this->_Quality = $value;
	}
	

  function __construct()
  {
    parent::__construct();

    
		$this->setBgColor('#F6F6F6');
		$this->setWmode('window');
		$this->setQuality('high');
		$this->setCodeBase('Scripts/aurigma.imageuploaderflash.swf');

    
		$this->attributes['ThemeUrl'] = array('jsName' => 'themeUrl','jsType' => 'String','defaultValue' => '');
		$this->attributes['BgColor'] = array('jsName' => 'bgColor','jsType' => 'String','defaultValue' => '#F6F6F6');
		$this->attributes['Wmode'] = array('jsName' => 'wmode','jsType' => 'String','defaultValue' => 'window');
		$this->attributes['Quality'] = array('jsName' => 'quality','jsType' => 'String','defaultValue' => 'high');
		$this->attributes['CodeBase'] = array('jsName' => 'codeBase','jsType' => 'String','defaultValue' => 'Scripts/aurigma.imageuploaderflash.swf');

    if ($this->getCodeBase())
    {
      $this->setCodeBase(UploaderUtils::getPhpLibraryDirectory() . '/' . $this->getCodeBase());
    }
  }

}
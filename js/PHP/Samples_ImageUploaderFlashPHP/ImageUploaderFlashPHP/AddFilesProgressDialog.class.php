<?php

class AddFilesProgressDialog {
  public $attributes;

  
	private $_Text;
	/**
	* @return string
	*/
	public function getText() {
		if (isset($this->_Text))
			return $this->_Text;
		else
			return null;
	}
	public function setText($value) {
		$this->_Text = $value;
	}
	

  function __construct(){
    
		$this->setText('Adding files to upload list...');

    $this->attributes = array();
    
		$this->attributes['Text'] = array('jsName' => 'text','jsType' => 'String','defaultValue' => 'Adding files to upload list...');
  }

}
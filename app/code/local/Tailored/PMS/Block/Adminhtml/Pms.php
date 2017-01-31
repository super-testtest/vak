<?php


class Tailored_PMS_Block_Adminhtml_Pms extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_pms";
	$this->_blockGroup = "pms";
	$this->_headerText = Mage::helper("pms")->__("Pms Manager");
	$this->_addButtonLabel = Mage::helper("pms")->__("Add New Item");
	parent::__construct();
	
	}

}
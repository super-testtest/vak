<?php
class Tailored_PMS_Adminhtml_PmsbackendController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("PMS Codes"));
	   $this->renderLayout();
    }
}
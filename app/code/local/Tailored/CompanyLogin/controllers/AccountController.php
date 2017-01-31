<?php
//require_once Mage::getModuleDir('controllers','Mage_Customer').DS."AccountController.php";
class Tailored_CompanyLogin_AccountController extends Mage_Core_Controller_Front_Action
{
	
	public function companyloginAction()
	{
		
		//echo $this->getLayout()->createBlock('core/template')->setTemplate('company/form/login.phtml')->toHtml();
		$this->loadLayout();
         $this->renderLayout();
		
	}

}
?>
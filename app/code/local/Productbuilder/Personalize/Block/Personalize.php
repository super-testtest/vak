<?php 
class Productbuilder_Personalize_Block_Personalize extends Mage_Core_Block_Template
{
  public function __construct ()
  {
  	return parent::__construct();
  }

  public function _prepareLayout()
  {
	    $this->addMessages(Mage::getSingleton('core/session')->getMessages(true));
	    parent::_prepareLayout();
  }

}
?>
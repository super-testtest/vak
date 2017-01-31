<?php 
class Productbuilder_Personalize_Block_View extends Mage_Catalog_Block_Product_View
{
	public function _prepareLayout()
	{
		parent::_prepareLayout();
		$helper = Mage::helper('personalize');
		if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) 
		{
		    $breadcrumbs->addCrumb('home', array('label'=>$helper->__('Home'), 'title'=>$helper->__('Go to Home Page'), 'link'=>Mage::getBaseUrl()));
    		$breadcrumbs->addCrumb('personalized', array('label'=>$helper->__('Personalized'), 'title'=>$helper->__('Personalized')));
        }
	}

	public function getAvailablePmsCodes(){
		$read = Mage::getSingleton('core/resource')->getConnection('core_read'); 
		
		$query = 'SELECT * FROM pms order by id ASC';

		$results = $read->fetchAll($query);
		return $results;
		
	} 
}
?>
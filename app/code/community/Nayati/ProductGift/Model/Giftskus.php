<?php
/**
 * 
 * @author Nayati 
 */
class Nayati_ProductGift_Model_Giftskus extends Mage_Core_Model_Abstract
{
	public function _construct()
    {    
        parent::_construct();
    	$this->_init('productgift/giftskus');
    }    
}
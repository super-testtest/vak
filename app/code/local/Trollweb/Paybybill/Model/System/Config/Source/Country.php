<?php

class Trollweb_Paybybill_Model_System_Config_Source_Country
{
  public function toOptionArray()
  {

    $countries = array(
      array('value' => 'NO', 'label' => Mage::helper('paybybill')->__('Norway')),
      array('value' => 'SE', 'label' => Mage::helper('paybybill')->__('Sweden')),
      array('value' => 'DK', 'label' => Mage::helper('paybybill')->__('Denmark')),
      array('value' => 'FI', 'label' => Mage::helper('paybybill')->__('Finland')),
      array('value' => 'NL', 'label' => Mage::helper('paybybill')->__('Netherlands')),
      array('value' => 'DE', 'label' => Mage::helper('paybybill')->__('Germany')),
                      );

    return $countries;
  }

}
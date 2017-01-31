<?php

class Trollweb_Paybybill_Model_System_Config_Source_Distribution
{
  public function toOptionArray()
  {

    return array(
      array('value' => 'Company', 'label' => Mage::helper('paybybill')->__('Gothia')),
      array('value' => 'Client', 'label' => Mage::helper('paybybill')->__('The store')),
                );
  }

}
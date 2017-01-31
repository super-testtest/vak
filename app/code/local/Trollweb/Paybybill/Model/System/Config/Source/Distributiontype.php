<?php

class Trollweb_Paybybill_Model_System_Config_Source_Distributiontype
{
  public function toOptionArray()
  {

    return array(
      array('value' => 'Paper', 'label' => Mage::helper('paybybill')->__('Paper')),
      array('value' => 'Email', 'label' => Mage::helper('paybybill')->__('E-Mail')),
                );
  }

}
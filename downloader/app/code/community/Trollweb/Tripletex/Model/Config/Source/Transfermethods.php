<?php

class Trollweb_Tripletex_Model_Config_Source_Transfermethods 
{
    const METHOD_ORDER      = 'order';
    const METHOD_INVOICE    = 'invoice';

    public function toOptionArray()
    {
        $list = array(
            array('label' => Mage::helper('tripletex')->__('ordre'), 'value' => self::METHOD_ORDER),
            array('label' => Mage::helper('tripletex')->__('faktura'), 'value' => self::METHOD_INVOICE),
        );

        return $list;
    }
}

<?php
class W3Themes_Featuredproduct_Model_Config_Sort
{

    public function toOptionArray()
    {
        return array(
            array('value'=>'name', 'label'=>Mage::helper('adminhtml')->__('Name')),
            array('value'=>'price', 'label'=>Mage::helper('adminhtml')->__('Price'))
        );
    }

}

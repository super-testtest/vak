<?php
class Trollweb_Paybybill_Block_Adminhtml_Form_Html_Select extends Mage_Core_Block_Html_Select
{
    public function setInputName($value)
    {
        return $this->setName($value);
    }
}
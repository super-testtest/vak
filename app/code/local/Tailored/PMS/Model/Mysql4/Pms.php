<?php
class Tailored_PMS_Model_Mysql4_Pms extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("pms/pms", "id");
    }
}
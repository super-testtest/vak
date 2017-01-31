<?php

class Trollweb_Paybybill_Model_Mysql4_Invoicedata extends Mage_Core_Model_Mysql4_Abstract {

    protected function _construct()
    {
        $this->_init('paybybill/invoicedata', 'invoicedata_id');
    }


}
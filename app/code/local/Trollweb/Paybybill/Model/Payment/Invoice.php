<?php

class Trollweb_Paybybill_Model_Payment_Invoice extends Trollweb_Paybybill_Model_Payment_Gothia
{

    protected $_code = 'pbbinvoice';


    protected function getDueDate($storeId=null)
    {
      if ((int)$this->getConfigData('invoice_duedate',$storeId) > 0) {
        return (int)$this->getConfigData('invoice_duedate',$storeId);
      }

      return false;
    }

}

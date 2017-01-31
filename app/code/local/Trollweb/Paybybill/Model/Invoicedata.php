<?php
class Trollweb_Paybybill_Model_Invoicedata extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('paybybill/invoicedata');
    }

    public function loadByInvoiceId($invoiceId)
    {
      $this->load($invoiceId,'invoice_id');
      if (!$this->getInvoiceId()) {
        $this->setInvoiceId($invoiceId);
      }
      return $this;
    }
}

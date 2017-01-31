<?php

class Trollweb_Paybybill_Block_Creditmemo_Fee extends Mage_Adminhtml_Block_Sales_Order_Creditmemo_Totals
{

   public function initTotals()
    {
        $parent = $this->getParentBlock();
        $cm = $this->getCreditmemo();
        if ($cm) {
          $_invoice = $cm->getInvoice();
          if (!$_invoice and ($cm->getInvoiceId())) {
            $_invoice = Mage::getModel('sales/order_invoice')->load($cm->getInvoiceId());
          }
          if ($_invoice and $_invoice->getId()) {
            $invoiceData = Mage::helper('paybybill')->getInvoiceData($_invoice->getIncrementId());
            if($invoiceData and ($invoiceData['invoice_fee'] > 0)){
                $fee = new Varien_Object();
                $fee->setLabel($this->__('PayByBill Invoice Fee'));
                $fee->setValue($_invoice->getOrder()->getStore()->convertPrice($invoiceData['invoice_fee'],false));
                $fee->setBaseValue($invoiceData['invoice_fee']);
                $fee->setCode('pbbinvoicefee');
                $parent->addTotalBefore($fee,'tax');
            }
          }
        }

        return $this;
    }

}
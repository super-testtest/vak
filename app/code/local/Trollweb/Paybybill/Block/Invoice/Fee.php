<?php

class Trollweb_Paybybill_Block_Invoice_Fee extends Mage_Core_Block_Abstract
{

   public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_invoice = $parent->getInvoice();
        if ($this->_invoice && $this->_invoice->getId()) {
          $invoiceData = Mage::helper('paybybill')->getInvoiceData($this->_invoice->getIncrementId());
          if($invoiceData){
              $fee = new Varien_Object();
              $fee->setLabel($this->__('PayByBill Invoice Fee'));
              $fee->setValue($this->_invoice->getOrder()->getStore()->convertPrice($invoiceData['invoice_fee'],false));
              $fee->setBaseValue($invoiceData['invoice_fee']);
              $fee->setCode('pbbinvoicefee');
              $parent->addTotalBefore($fee,'tax');
          }
        }
        else {
            $order = $parent->getOrder();
            $orderData = Mage::helper('paybybill')->getOrderData($order->getIncrementId());
            if($orderData and isset($orderData['invoice_fee']) and ($orderData['invoice_fee'] > $orderData['invoice_fee_invoiced'])) {
                $fee = new Varien_Object();
                $fee->setLabel($this->__('PayByBill Invoice Fee'));
                $fee->setValue($order->getStore()->convertPrice($orderData['invoice_fee'],false));
                $fee->setBaseValue($orderData['invoice_fee']);
                $fee->setCode('pbbinvoicefee');
                $parent->addTotalBefore($fee,'tax');
            }
        }

        return $this;
    }

}
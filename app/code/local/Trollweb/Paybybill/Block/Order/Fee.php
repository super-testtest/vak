<?php

class Trollweb_Paybybill_Block_Order_Fee extends Mage_Core_Block_Abstract
{

   public function initTotals()
   {
    $parent = $this->getParentBlock();
    $this->_order = $parent->getOrder();
    $orderData = Mage::helper('paybybill')->getOrderData($this->_order->getIncrementId());
    if($orderData and isset($orderData['invoice_fee'])) {
        $fee = new Varien_Object();
        $fee->setLabel($this->__('PayByBill Invoice Fee'));
        $fee->setValue($this->_order->getStore()->convertPrice($orderData['invoice_fee'],false));
        $fee->setBaseValue($orderData['invoice_fee']);
        $fee->setCode('pbbinvoicefee');
        $parent->addTotalBefore($fee,'tax');
    }
    return $this;
   }

}
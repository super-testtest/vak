<?php
class Trollweb_Paybybill_Model_Payment_Creditmemo_Total extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Creditmemo $cm)
    {
        if (!in_array($cm->getOrder()->getPayment()->getMethodInstance()->getCode(),array('pbbinvoice','pbbpartpay'))) {
            return $this;
        }


        $feeToCredit = 0;
        $baseFeeToCredit = 0;

        if ($cm->getInvoice()) {

          $invoiceData = Mage::getModel('paybybill/invoicedata')->loadByInvoiceId($cm->getInvoice()->getIncrementId());

          $store = $cm->getOrder()->getStore();
          $baseFeeToCredit = $invoiceData->getInvoiceFee();
          $feeToCredit =  $store->convertPrice($baseFeeToCredit,false);
        } else {
          $orderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($cm->getOrder()->getIncrementId());

          $store = $cm->getOrder()->getStore();
          $baseFeeToCredit = $orderData->getInvoiceFeeInvoiced();
          $feeToCredit =  $store->convertPrice($baseFeeToCredit,false);
        }

        $baseCMTotal = $cm->getBaseGrandTotal();
        $CMTotal = $cm->getGrandTotal();

        $cm->setBaseGrandTotal($baseCMTotal+$baseFeeToCredit);
        $cm->setGrandTotal($CMTotal+$feeToCredit);

        return $this;
    }

}
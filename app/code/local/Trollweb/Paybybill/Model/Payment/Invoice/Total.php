<?php
class Trollweb_Paybybill_Model_Payment_Invoice_Total extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        if (!in_array($invoice->getOrder()->getPayment()->getMethodInstance()->getCode(),array('pbbinvoice','pbbpartpay'))) {
            return $this;
        }

        $orderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($invoice->getOrder()->getIncrementId());

        $store = $invoice->getOrder()->getStore();
        $baseInvoiceFee = $orderData->getInvoiceFee()-$orderData->getInvoiceFeeTax();;
        $baseInvoiceFeeInvoiced = $orderData->getInvoiceFeeInvoiced()-$orderData->getInvoiceFeeTaxInvoiced();;
        $invoiceFee =  $store->convertPrice($baseInvoiceFee,false);
        $invoiceFeeInvoiced =  $store->convertPrice($baseInvoiceFeeInvoiced,false);

        if (!$invoiceFee || $baseInvoiceFee == $baseInvoiceFeeInvoiced){
            return $this;
        }

        $baseInvoiceTotal = $invoice->getBaseGrandTotal();
        $invoiceTotal = $invoice->getGrandTotal();

        $baseInvoiceTotal = $baseInvoiceTotal + ($baseInvoiceFee - $baseInvoiceFeeInvoiced);
        $invoiceTotal = $invoiceTotal + ($invoiceFee - $invoiceFeeInvoiced);

        $invoice->setBaseGrandTotal($baseInvoiceTotal);
        $invoice->setGrandTotal($invoiceTotal);

        return $this;
    }

}
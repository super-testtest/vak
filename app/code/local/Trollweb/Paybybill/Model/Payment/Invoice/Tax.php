<?php
class Trollweb_Paybybill_Model_Payment_Invoice_Tax extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        if (!in_array($invoice->getOrder()->getPayment()->getMethodInstance()->getCode(),array('pbbinvoice','pbbpartpay'))) {
            return $this;
        }

        $orderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($invoice->getOrder()->getIncrementId());

        $store = $invoice->getOrder()->getStore();
        $baseInvoiceFeeTax = $orderData->getInvoiceFeeTax();
        $baseInvoiceFeeTaxInvoiced = $orderData->getInvoiceFeeTaxInvoiced();

        $invoiceFeeTax =  $store->convertPrice($baseInvoiceFeeTax,false);
        $invoiceFeeTaxInvoiced =  $store->convertPrice($baseInvoiceFeeTaxInvoiced,false);


        $includeTax = true;

        $ifTax = 0;
        $baseIfTax = 0;

        if (!$invoiceFeeTax || $baseInvoiceFeeTax == $baseInvoiceFeeTaxInvoiced) {
          $includeTax = false;
        }

        if ($includeTax) {
          $ifTax += $invoiceFeeTax;
          $baseIfTax += $baseInvoiceFeeTax;
        }

        $order = $invoice->getOrder();

        $allowedTax     = $order->getTaxAmount() - $order->getTaxInvoiced();
        $allowedBaseTax = $order->getBaseTaxAmount() - $order->getBaseTaxInvoiced();
        $totalTax = $invoice->getTaxAmount();
        $baseTotalTax = $invoice->getBaseTaxAmount();

        if (!$invoice->isLast()
                && $allowedTax > $totalTax) {
            $newTotalTax           = min($allowedTax, $totalTax + $ifTax);
            $newBaseTotalTax       = min($allowedBaseTax, $baseTotalTax + $baseIfTax);

            $invoice->setTaxAmount($newTotalTax);
            $invoice->setBaseTaxAmount($newBaseTotalTax);

            $invoice->setGrandTotal($invoice->getGrandTotal() - $totalTax + $newTotalTax);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() - $baseTotalTax + $newBaseTotalTax);
        }
        else {
            // Remove Invoice Fee Tax from SubtotalInclTax.
            $invoice->setSubtotalInclTax($invoice->getSubtotalInclTax()-$ifTax);
            $invoice->setBaseSubtotalInclTax($invoice->getBaseSubtotalInclTax()-$baseIfTax);
        }

        return $this;
    }
}
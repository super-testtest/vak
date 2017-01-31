<?php

class Trollweb_Paybybill_Model_Observer
{

  public function sales_order_invoice_save_after($observer)
  {
    $invoice = $observer->getInvoice();
    /* @var $order Mage_Sales_Model_Order */
    $order = $invoice->getOrder();
    $payment =  $order->getPayment();

      /* @var $paymentInstance Trollweb_Paybybill_Model_Payment_Gothia */
    $paymentInstance = $payment->getMethodInstance();
    if ($paymentInstance instanceof Trollweb_Paybybill_Model_Payment_Gothia) {
        if (Mage::getStoreConfig('payment/' . $paymentInstance->getCode() . '/batch_capture')) {
            $order->setStatus('pending_invoice')->save();
            return $this;
        }
        $paymentInstance->setStore($invoice->getStoreId())->insertInvoice($invoice);
    }
    return $this;

  }

  public function sales_order_creditmemo_save_after(Varien_Event_Observer $observer)
  {
    $cm = $observer->getEvent()->getCreditmemo();

    // If this creditmemo is created within the 10 last seconds, its OK to export.
    if ((strtotime($cm->getCreatedAt())+10 >= strtotime(now())) and ($cm->getInvoice()) and ($cm->getTransactionId() == $cm->getInvoice()->getTransactionId())) {

      $order = $cm->getOrder();
      $payment =  $order->getPayment();

      $paymentInstance = $payment->getMethodInstance();
      if ($paymentInstance instanceof Trollweb_Paybybill_Model_Payment_Gothia) {
        $paymentInstance->setStore($cm->getStoreId())->insertCreditMemo($cm);
      }
    }
  }


  public function order_cancel_after($observer)
  {
    $order = $observer->getOrder();

    $payment = $order->getPayment();
    $paymentInstance = $payment->getMethodInstance();
    if ($paymentInstance instanceof Trollweb_Paybybill_Model_Payment_Gothia) {
      $paymentInstance->setStore($order->getStoreId())->cancelOrder($order);
    }
  }


    public function runBatch(){
        Mage::log('running');

        /* @var $collection Mage_Sales_Model_Resource_Order_Collection */
        $collection = Mage::getModel('sales/order')->getCollection();
        $collection->addAttributeToFilter('status', array('eq' => 'pending_invoice'));

        /* @var $errors array */
        $errors = array();

        /* @var $order Mage_Sales_Model_Order*/
        foreach($collection as $order){
            /* @var $payment Trollweb_Paybybill_Model_Payment_Gothia */
            $payment = $order->getPayment()->getMethodInstance();
            if ($payment instanceof Trollweb_Paybybill_Model_Payment_Gothia) {
                /* @var $invoices Mage_Sales_Model_Resource_Order_Invoice_Collection */
                $invoices = $order->getInvoiceCollection();
                /* @var $invoice Mage_Sales_Model_Order_Invoice */
                foreach ($invoices as $invoice) {
                   try {
                       $payment->setStore($invoice->getStore())->insertInvoice($invoice);
                       $order->setStatus('complete')->save();
                   }catch (Exception $e){
                       $errors[$invoice->getIncrementId()] = $e->getMessage();
                   }
                }
            }

        }

        if(count($errors)){
            $senderName = Mage::getStoreConfig('trans_email/ident_general/name');
            $senderEmail = Mage::getStoreConfig('trans_email/ident_general/email');
            $reciverEmail = Mage::getStoreConfig('advanced/paybybill/batch_error_email');

            $subject = Mage::helper('paybybill')->__('Error running batch invoice');

            $body = "Errors when running batch invoice!\r\n\r\n";
            foreach($errors as $invoiceNo => $message){
                $body = $body."Invoice: ".$invoiceNo." Error: ".$message."\r\n";
            }

            /* @var $email Mage_Core_Model_Email */
            $email = Mage::getModel('core/email');
            $email->setFromName($senderName);
            $email->setFromEmail($senderEmail);
            $email->setToEmail($reciverEmail);
            $email->setSubject($subject);
            $email->setBody($body);
            $email->send();
        }
        return $this;

    }
}
<?php

class Trollweb_Paybybill_Model_Payment_Api_Invoice extends Mage_Core_Model_Abstract
{

  public function getRequest()
  {
    if (!$this->getInvoice() and !$this->getCreditMemo()) {
      throw new Exception('No invoice set in invoice request.');
    }
    if (!$this->getOrderData()) {
      throw new Exception('No paybybill orderdata set in invoice request.');
    }

    $_orderData = $this->getOrderData();

    if ($this->getInvoice()) {
      $_invoice = $this->getInvoice();
      $_shippingAddress = $_invoice->getShippingAddress();
      $this->setStoreId($_invoice->getStoreId());

      $_request = array(
        'Amount' 		                => number_format($_invoice->getBaseGrandTotal(),2,'.',''),
        'CustNo'		                => $_orderData->getCustNo(),
        'CurrencyCode'              => $_invoice->getBaseCurrencyCode(),
        'DeliveryAddress'	          => $_shippingAddress->getStreet(1),
        'DeliveryCity'		          => $_shippingAddress->getCity(),
        'DeliveryCountry'           => $_shippingAddress->getCountry(),
        'DeliveryPostCode'	        => $_shippingAddress->getPostcode(),
        'DirectDebetBankAccountNo'  => $_orderData->getBankAccount(),
        'DirectDebetBankID'					=> $_orderData->getBankId(),
        'InvoiceDate'								=> date("Y-m-d",strtotime($_invoice->getCreatedAt())),
        'InvoiceLines'							=> $this->getInvoiceLines($_invoice),
        'InvoiceNo'									=> $_invoice->getIncrementId(),
        'InvoiceProfileNo'					=> $this->getInvoiceProfileNo(),
        'NetAmount'									=> number_format($_invoice->getBaseGrandTotal()-$_invoice->getBaseTaxAmount(),2,'.',''),
        'OrderNo'										=> $_invoice->getOrder()->getIncrementId(),
        'VATAmount'									=> number_format($_invoice->getBaseTaxAmount(),2,'.',''),
      );

      if ($this->getDueDate()) {
        $_request['DueDate'] = $this->getDueDate();
      }

    }
    elseif ($this->getCreditMemo()) {
      $_creditMemo = $this->getCreditMemo();
      $_shippingAddress = $_creditMemo->getShippingAddress();
      $this->setStoreId($_creditMemo->getStoreId());

      $_invoice_id = $_creditMemo->getInvoiceId();
      $_invoice = Mage::getModel('sales/order_invoice')->load($_invoice_id);


      $_request = array(
        'Amount' 		                => number_format($_creditMemo->getBaseGrandTotal()*-1,2,'.',''),
        'CustNo'		                => $_orderData->getCustNo(),
        'DeliveryAddress'	          => $_shippingAddress->getStreet(1),
        'DeliveryCity'		          => $_shippingAddress->getCity(),
        'DeliveryCountry'           => $_shippingAddress->getCountry(),
        'DeliveryPostCode'	        => $_shippingAddress->getPostcode(),
        'DirectDebetBankAccountNo'  => '', // ??
        'DirectDebetBankID'					=> '', // ??
        'InvoiceDate'								=> date("Y-m-d",strtotime($_creditMemo->getCreatedAt())),
        'InvoiceLines'							=> $this->getInvoiceLines($_creditMemo,true),
        'InvoiceNo'									=> 'K'.$_creditMemo->getInvoice()->getIncrementId(),
      	'InvoiceProfileNo'					=> $this->getInvoiceProfileNo(),
        'CrossedInvoiceNo'					=> $_invoice->getIncrementId(),
        'NetAmount'									=> number_format(($_creditMemo->getBaseGrandTotal()-$_creditMemo->getBaseTaxAmount())*-1,2,'.',''),
        'OrderNo'										=> $_creditMemo->getOrder()->getIncrementId(),
        'VATAmount'									=> number_format($_creditMemo->getBaseTaxAmount()*-1,2,'.',''),
      );

    }

    return $_request;
  }

  protected function getInvoiceLines($invoice,$credit=false)
  {

    $base = 1;
    if ($credit) {
      $base = -1;
    }

    $lines = array();
    foreach($invoice->getAllItems() as $item)
    {

      if ($item->getOrderItem()->getParentItem()) {
        continue; // Skip child items.
      }

      $lines[] = array(
        'GrossAmount'							=> $item->getBaseRowTotalInclTax()*$base,
        'ItemDescription'					=> $item->getName(),
        'ItemID'									=> $item->getSku(),
        'NetAmount'								=> $item->getBaseRowTotal()*$base,
        'Quantity'  							=> $item->getQty(),
        'TaxAmount'								=> $item->getBaseTaxAmount()*$base,
        'UnitPrice'								=> $item->getBasePrice()*$base,
      );
    }

    // Add shipping if exists
    if ($invoice->getShippingInclTax() > 0) {
      $lines[] = array(
          'GrossAmount'							=> $invoice->getBaseShippingInclTax()*$base,
          'ItemDescription'					=> $invoice->getOrder()->getShippingDescription(),
          'ItemID'									=> 'shipping',
          'NetAmount'								=> $invoice->getBaseShippingAmount()*$base,
          'Quantity'  							=> '1',
          'TaxAmount'								=> $invoice->getBaseShippingTaxAmount()*$base,
      );
    }

    // Add invoice fee if this is the first invoice.
    if ($credit || ($invoice->getOrder()->hasInvoices() == 1)) {
      $orderData = $this->getOrderData();

      if ($orderData['invoice_fee'] > 0) {
        $lines[] = array(
            'GrossAmount'							=> $orderData['invoice_fee']*$base,
            'ItemDescription'					=> Mage::helper('paybybill')->__('PayByBill Invoice Fee'),
            'ItemID'									=> 'invoicefee',
            'NetAmount'								=> ($orderData['invoice_fee']-$orderData['invoice_fee_tax'])*$base,
            'Quantity'  							=> '1',
            'TaxAmount'								=> $orderData['invoice_fee_tax']*$base,
        );
      }
    }

    return $lines;
  }


  /**
   *
   * Set the duedate for an invoice.
   * You can either specify the number of days into the future
   * or a spesicif date in the format YYYY-MM-DD
   *
   * @param mixed $date
   */
  public function setDueDate($date) {
    if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$date)) {
      $this->setData('due_date',$date.'T00:00:00');
    }
    else {
      $this->setData('due_date',date("Y-m-d",time()+(60*60*24*$date)).'T00:00:00');
    }
  }


}
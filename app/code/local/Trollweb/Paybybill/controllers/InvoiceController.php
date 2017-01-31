<?php

class Trollweb_Paybybill_InvoiceController extends Mage_Adminhtml_Controller_Action
{

  public function fetchPdfAction()
  {
    $invoiceId = $this->getRequest()->getParam('invoice_id');
    $invoice = Mage::getModel('sales/order_invoice')->load($invoiceId);
    if ($invoice->getId()) {
        $method = $invoice->getOrder()->getPayment()->getMethodInstance()->getCode();
      
      $link = Mage::helper('paybybill/api')->setStoreId($invoice->getOrder()->getStoreId())->getInvoiceLink($method,$invoice->getIncrementId());

      if (!$link['error']) {
        $this->getResponse()->setRedirect('http://'.$link['link']);
        return;
      }
      else {
        $errorMsg = $this->__('Unable to fetch document.');

        if (!empty($link['message'])) {
          $errorMsg .= ' '.$this->__('Error message from PBB: %s',$link['message']);
        }
        $this->_getSession()->addError($errorMsg);
      }
    }
    else {
      $this->_getSession()->addError($this->__('No invoice found.'));
    }
    $this->_redirect('adminhtml/sales_invoice/view',array('invoice_id' => $invoiceId));
  }


}
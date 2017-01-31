<?php
class Trollweb_Paybybill_TermsController extends Mage_Checkout_Controller_Action
{

  public function invoiceAction()
  {
    $block = $this->getLayout()->createBlock('paybybill/info');
    $this->getResponse()->setBody($block->getInvoice());
  }


  public function partpaymentAction()
  {
    $block = $this->getLayout()->createBlock('paybybill/info');
    $this->getResponse()->setBody($block->getPartpayment());
  }

  public function PartPaymentTermsAction()
  {
    $pbbData = Mage::getSingleton('checkout/session')->getPayByBillCustomerData();
    $result = Mage::helper('paybybill/api')->GetAccountTermsAndConditions('pbbpartpay',$pbbData['cust_no']);
    if ($result['error']) {
      $this->getResponse()->setBody($this->__('Unable to fetch terms and conditions. Please try again.'));
    }
    else {
      $pbbData['pbbterms'] = $result['data'];
      unset($pbbData['pbbterms']['html']);
      Mage::getSingleton('checkout/session')->setPayByBillCustomerData($pbbData);

      $this->getResponse()->setBody($result['data']['html']);
    }
  }

}
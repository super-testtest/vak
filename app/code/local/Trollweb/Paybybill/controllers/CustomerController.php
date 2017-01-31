<?php
class Trollweb_Paybybill_CustomerController extends Mage_Checkout_Controller_Action
{

  public function checkAction()
  {

    $gothiaData = $this->getRequest()->getPost('payment');

    $gothiaCustomer = Mage::getModel('paybybill/payment_api_customer');
    $gothiaCustomer->setMethod($gothiaData['method']);
    $gothiaCustomer->extractFromQuote($this->checkout()->getQuote());
    $gothiaCustomer->extractFromForm($gothiaData,$gothiaData['method']);
    $gothiaCustomer->setDistributionBy(Mage::getStoreConfig('payment/'.$gothiaData['method'].'/distribution_by'));
    $gothiaCustomer->setDistributionType(Mage::getStoreConfig('payment/'.$gothiaData['method'].'/distribution_type'));


    switch ($gothiaData['method']) {
      case 'pbbdirect':
         $_form = 'formdd';
         break;
      case 'pbbpartpay':
         $_form = 'formpp';
         break;
      default:
         $_form = 'form';
    }

    if ($gothiaCustomer->checkCredit()) {

        $html = $this->getLayout()
          ->createBlock('paybybill/'.$_form)
          ->setMethod(Mage::helper('payment')->getMethodInstance($gothiaData['method']))
          ->setAjaxCall(true);

        if (isset($gothiaData['dd_bankid'])) {
          $html->setBankId($gothiaData['dd_bankid']);
        }

        if (isset($gothiaData['dd_bankaccount'])) {
          $html->setBankAccount($gothiaData['dd_bankaccount']);
        }

        $result = array('error' => false,
        		'html' => $html->toHtml(),
                        'address' => $gothiaCustomer->getData('customerdata'),
                       );
    }
    else {
        $result = array('error' => true,
        		'html' => $gothiaCustomer->getErrorMessage(),
                       );
    }
    $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
  }


  protected function checkout()
  {
    return Mage::getSingleton('checkout/session');
  }
}

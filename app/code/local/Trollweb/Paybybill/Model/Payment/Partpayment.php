<?php

class Trollweb_Paybybill_Model_Payment_Partpayment extends Trollweb_Paybybill_Model_Payment_Gothia
{

    protected $_code = 'pbbpartpay';
    protected $_formBlockType = 'paybybill/formpp';


    public function assignData($data)
    {
      $checkout = $this->getCheckout();
      $checkout->setPayByBillPartPaymentAccepted($data->getApproveterms() == "on");
    }

    public function validate()
    {
      parent::validate();

      // Check if things are approved
      if (!$this->getCheckout()->getPayByBillPartPaymentAccepted()) {
        $this->getCheckout()->setPayByBillApproved(false);
        Mage::throwException('You need to accept terms and conditions for part payment');
      }

      $pbbData = $this->getCheckout()->getPayByBillCustomerData();
      if (isset($pbbData['pbbterms'])) {
       $result = array('data' => $pbbData['pbbterms']);
      }
      else {
        $result = Mage::helper('paybybill/api')->GetAccountTermsAndConditions($this->_code,$pbbData['cust_no']);

        if ($result['error']) {
          Mage::throwException('Unable to fetch terms and conditions. Please try again.');
        }
      }

      if ($result['data']['require_confirmation'])
      {
        $result = Mage::helper('paybybill/api')->AcceptAccountTermsAndConditions($this->_code,$result['data']['accept_id'],$pbbData['cust_no']);
        if ($result['error']) {
          Mage::throwException('There was an errror while accepting terms and conditions.');
        }
      }
    }


    public function isAvailable($quote = null)
    {
      // Partpayment is only allowed for
      $isAvail = parent::isAvailable($quote);

      if ($isAvail && $quote) {
          if ($quote->getBaseGrandTotal() < $this->getPPLimit($quote->getBaseCurrencyCode())) {
            $isAvail = false;
          }
      }
      else {
        $isAvail = false;
      }

      return $isAvail;

    }

    protected function getPPLimit($currencyCode)
    {
      switch ($currencyCode) {
        case 'NOK': return 400;
        case 'SEK': return 400;
        case 'DKK': return 400;
        case 'EUR': return 50;

        default: // Unknown currency code - returning a huge amount.
            return 99999999999;
      }
    }


}

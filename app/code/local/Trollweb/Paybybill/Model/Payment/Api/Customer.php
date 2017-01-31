<?php

class Trollweb_Paybybill_Model_Payment_Api_Customer extends Mage_Core_Model_Abstract
{
  public function extractFromQuote(Mage_Sales_Model_Quote $quote)
  {
    if (!$quote) {
      $this->setErrorMessage(Mage::helper('paybybill')->__('No quote found.'));
      return false;
    }

    $address = $quote->getBillingAddress();
    if (!$address) {
      $this->setErrorMessage(Mage::helper('paybybill')->__('No address found.'));
      return false;
    }

    $isCompany = false;
    if (strlen(trim($address->getCompany()))>0) {
        $isCompany = true;
    }
    
    $this->setCustNo('');
    $this->setCustomerCategory($isCompany ? 'Company' : 'Person'); // 0 ? 'Person' : 'Company'
    $this->setCurrencyCode($quote->getBaseCurrencyCode());

    if ($quote->getCustomerDob()) {
      $this->setBirthNumber(Mage::helper('paybybill/validate')->dob($quote->getCustomerDob()));
    }

    $address = $quote->getBillingAddress();

    if ($address) {
       $this->setAddress($address->getStreet(1))
            ->setCountryCode($address->getCountryId())
            ->setEmail($address->getEmail())
            ->setFirstName($isCompany ? $address->getFirstname(). ' ' .$address->getLastname() : $address->getFirstname())
            ->setLastName($isCompany ? $address->getCompany() : $address->getLastname())
            ->setPhone($address->getTelephone())
            ->setPostalCode($address->getPostcode())
            ->setPostalPlace($address->getCity())
            ->setPrefix($address->getPrefix());
    }

    $_email = $this->getEmail();
    if (empty($_email)) {
      $this->setEmail($quote->getCustomerEmail());
    }

    return $this;

  }

  public function extractFromOrder(Mage_Sales_Model_Order $order)
  {
    if (!$order) {
      $this->setErrorMessage(Mage::helper('paybybill')->__('No order found.'));
      return false;
    }

    $address = $order->getBillingAddress();
    if (!$address) {
      $this->setErrorMessage(Mage::helper('paybybill')->__('No address found.'));
      return false;
    }
    
    $isCompany = false;
    if (strlen(trim($address->getCompany()))>0) {
        $isCompany = true;
    }

    $this->setCustNo('');
    $this->setCustomerCategory($isCompany ? 'Company' : 'Person'); // 0 ? 'Person' : 'Company'
    $this->setCurrencyCode($order->getBaseCurrencyCode());

    if ($order->getCustomerDob()) {
      $this->setBirthNumber(Mage::helper('paybybill/validate')->dob($order->getCustomerDob()));
    }

    $address = $order->getBillingAddress();
    if ($address) {
       $this->setAddress($address->getStreet(1))
            ->setCountryCode($address->getCountryId())
            ->setEmail($address->getEmail())
            ->setFirstName($isCompany ? $address->getFirstname(). ' ' .$address->getLastname() : $address->getFirstname())
            ->setLastName($isCompany ? $address->getCompany() : $address->getLastname())
            ->setPhone($address->getTelephone())
            ->setPostalCode($address->getPostcode())
            ->setPostalPlace($address->getCity())
            ->setPrefix($address->getPrefix());
    }

    if (!$this->getEmail()) {
      $this->setEmail($order->getCustomerEmail());
    }


    return $this;
  }

  public function extractFromForm($form,$method)
  {
    foreach ($form as $key => $value) {
      if (strncmp($key,$method.'_',strlen($method)+1) == 0) {
        $newkey = substr($key,strlen($method)+1);
        $this->setData($newkey,$value);
      }
      else {
        $this->setData($key,$value);
      }
    }
    $this->setData('method',$method);
  }

  public function setPrefix($prefix)
  {
    // Check for prefix mappings
    $method = $this->getMethod();
    $prefixes = Mage::getStoreConfig('payment/'.$method.'/social_status_mapping',$this->getStoreId());
    if ($prefixes) {
      $prefixArray = @unserialize($prefixes);
      if (is_array($prefixArray))
      {
        foreach ($prefixArray as $p) {
          if ($p['social_title'] == $prefix) {
            // Found a mapping, return that.
            $this->setData('prefix',$p['pbb_social_title']);
            return $this;
          }
        }
      }
    }
    $this->setData('prefix',$prefix);
    return $this;
  }

  public function checkCredit()
  {

    $result = false;
    if ($this->validate() && $this->check()) {
      // If GetCustomerLimit is disabled we use the stored default credit limit
      $method = $this->getMethod();
      $disabled = Mage::getStoreConfig('payment/'.$method.'/disable_getcustomerlimit',$this->_storeid);

      if ($this->getCreditLimit() >= $this->checkout()->getQuote()->getBaseGrandTotal() || $disabled) {
        $this->checkout()->setPayByBillApproved(true);
        $this->checkout()->setPayByBillCustomerData($this->getData());

        if($this->getCreditLimit() > 0 && !$disabled) {
          $this->checkout()->setPayByBillCreditLimit($this->getCreditLimit());
        }

        $result = true;
      }
      else {
        $this->createError(Mage::helper('paybybill')->__('You only get credit of %s',Mage::app()->getStore()->formatPrice($this->getCreditLimit(),false)),false);
      }
    }

    return $result;
  }

  public function validate()
  {
    switch($this->getCountryCode())
    {
      case 'NL':
        if (!$this->getHousenumber()) {
          $this->createError('You must specify a housenumber');
          return false;
        }
      case 'DE':
        $this->setSsNumber(Mage::helper('paybybill/validate')->birthday($this->getBirthNumber()));
        if (!$this->getSsNumber()) {
          $this->createError('You must specify birth date in format DD.MM.YYYY or DDMMYYYY');
          return false;
        }
        break;
      case 'NO':
      case 'SE':
      case 'FI':
        if (!$this->getSsNumber()) {
          $this->createError('You must specify a social security number.');
          return false;
        }
        break;
      case 'DK':
        $this->setSsNumber(Mage::helper('paybybill/validate')->birthday($this->getSsNumber()));
        if (!$this->getSsNumber()) {
          $this->createError('You must specify birth date in format DD.MM.YYYY or DDMMYYYY');
          return false;
        }
        break;
      default:
        $this->createError('An invalid country code is choosen');
        return false;
    }

    if (!$this->getPostalCode()) {
      $this->createError('You must specify a postalcode');
      return false;
    }

    if (!$this->getEmail()) {
      $this->createError('You have to specify your email address');
      return false;
    }

    return true;

  }

  protected function createError($message,$translate = true)
  {
    if ($translate) {
      $this->setErrorMessage(Mage::helper('paybybill')->__($message));
    }
    else {
      $this->setErrorMessage($message);
    }
  }

  protected function check()
  {
    $result = Mage::helper('paybybill/api')->CheckCustomer($this);

    if ($result && !$result['error']) {
      $this->addData($result['data']);
      return true;
    }
    else {
      Mage::log('[PayByBill] '.$result['message'],Zend_Log::ERR);
      $this->createError('Your credit check failed. Please check that the information you gave was correct.');
    }


    return false;
  }

  public function getRequest()
  {

    if ($this->getCountryCode() == "NO" &&
        strlen($this->getSsNumber()) == 9 ) {
      $this->setCustomerCategory('Company');
    }

    return array(
        'Address' => $this->getAddress(),
        'CountryCode' => $this->getCountryCode(),
        'CurrencyCode' => $this->getCurrencyCode(),
        'CustNo' => $this->getCustNo(),
        'CustomerCategory' => $this->getCustomerCategory(),
        'DistributionBy' => $this->getDistributionBy(),
        'DistributionType' => $this->getDistributionType(),
        'Email' => $this->getEmail(),
        'FirstName' => $this->getFirstName(),
        'LastName' => $this->getLastName(),
        'Organization_PersonalNo' => $this->getSsNumber(),
        'Phone' => $this->getPhone(),
        'PostalCode' => $this->getPostalCode(),
        'PostalPlace' => $this->getPostalPlace(),
        'SocialTitle' => $this->getPrefix(),
    );
  }

  protected function checkout()
  {
    return Mage::getSingleton('checkout/session');
  }

}

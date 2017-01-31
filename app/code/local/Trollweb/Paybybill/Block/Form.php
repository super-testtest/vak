<?php

class Trollweb_Paybybill_Block_Form extends Mage_Payment_Block_Form
{

    protected $_pbb_template = 'paybybill/form.phtml';

    protected function _construct()
    {
      parent::_construct();
      $this->setTemplate($this->_pbb_template);
    }


    public function getFormHtml()
    {
      $language = $this->getLanguageCode();

      $this->setTemplate('paybybill/forms/'.strtolower($language).'.phtml');

      $html = $this->_toHtml();
      if (empty($html)) {
        // Render default.
        $this->setTemplate('paybybill/forms/no.phtml');
        $html = $this->_toHtml();
      }
      //Mage::helper('paybybill/api')->checkUser();

      $this->setTemplate($this->_pbb_template);
      return $html;
    }

    public function isApproved()
    {
      return $this->checkout()->getPayByBillApproved();
    }

    public function getApprovedCredits() {
        if ($this->checkout()->getPayByBillCreditLimit() > 0) {
                return Mage::app()->getStore()->getBaseCurrency()->format($this->checkout()->getPayByBillCreditLimit(), array(), false);
        }
        else {
                return false;
        }
    }

    public function getInvoiceDueDays() {
      return Mage::getStoreConfig('payment/pbbinvoice/invoice_duedate');
    }

    protected function checkout()
    {
      return Mage::getSingleton('checkout/session');
    }

    public function getLanguageCode()
    {
      try {
        $quote = $this->checkout()->getQuote();
        $language = $quote->getBillingAddress()->getCountryId();
      }
      catch (Exception $e) {
        // Something went wrong - default back to norway.
        $language = "no";
      }
      return $language;
    }

    public function getConditionsLink()
    {
      switch (strtolower($this->getLanguageCode())) {
        case 'no': return 'http://www.gothiagroup.com/no/vilkaarfaktura/';
        default: return 'http://www.gothiagroup.com';
      }
    }
}

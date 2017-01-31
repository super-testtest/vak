<?php
class Trollweb_Paybybill_Block_Info extends Mage_Core_Block_Template
{
    public $partpaymentLateFee;

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('paybybill/info.phtml');
    }

    /**
     * Retrieve info model
     *
     * @return Mage_Payment_Model_Info
     */
    public function getInfo()
    {
        $info = $this->getData('info');
        if (!($info instanceof Mage_Payment_Model_Info)) {
            Mage::throwException($this->__('Cannot retrieve the payment info model object.'));
        }
        return $info;
    }

    /**
     * Retrieve payment method model
     *
     * @return Mage_Payment_Model_Method_Abstract
     */
    public function getMethod()
    {
        return $this->getInfo()->getMethodInstance();
    }


    public function getApprovedCredits()
    {
      return Mage::app()->getStore()->formatPrice($this->checkout()->getPayByBillCredit(),false);
    }

    public function getPBBInfo()
    {
      $data = array();
      $order = $this->getInfo()->getOrder();
      if ($order) {
        $pbbOrderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($this->getInfo()->getOrder()->getIncrementId());

        if ($this->getIsSecureMode()) {
          $data['PayByBill Customer Number'] = $pbbOrderData->getCustNo();
          $data['Rating']  = $pbbOrderData->getRating();
          $data['Reservation ID'] = $pbbOrderData->getReservationId();
        }

        if (Mage::app()->getRequest()->getParam('invoice_id')) {
          $invoice = Mage::getModel('sales/order_invoice')->load(Mage::app()->getRequest()->getParam('invoice_id'));
          if ($invoice->getId()) {
            $pbbInvoiceData = Mage::getModel('paybybill/invoicedata')->loadByInvoiceId($invoice->getIncrementId());
            if ($pbbInvoiceData->getKid()) {
              $data['KID'] = $pbbInvoiceData->getKid();
            }
          }
        }
      }
      return $data;
    }

    public function getInvoiceLink()
    {
      $invoiceId = $this->getRequest()->getParam('invoice_id');
      if ($invoiceId && !$this->getMethod()->getConfigData('external_erp',$this->getInfo()->getOrder()->getStoreId())) {
        return $this->getUrl('paybybill/invoice/fetchPdf',array('invoice_id' => $invoiceId, 'key'=>Mage::getSingleton('adminhtml/url')->getSecretKey('invoice','fetchPdf')));
      }
      else {
        return false;
      }
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

    public function getIsSecureMode()
    {
        if ($this->hasIsSecureMode()) {
            return (bool)(int)$this->_getData('is_secure_mode');
        }
        if (!$payment = $this->getInfo()) {
            return true;
        }
        if (!$method = $payment->getMethodInstance()) {
            return true;
        }
        return Mage::app()->getStore($method->getStore())->isAdmin();
    }

    public function getInvoice($lang=null)
    {
        if (!$lang) {
          $lang = $this->getLanguageCode();
        }


        $this->setInvoiceFee(Mage::getStoreConfig('payment/pbbinvoice/invoice_fee'));
        $this->setInvoiceDueDays(Mage::getStoreConfig('payment/pbbinvoice/invoice_duedate'));
        $this->setInvoiceLateFee(Mage::getStoreConfig('payment/pbbinvoice/invoice_late_fee'));

        if($this->invoiceSentSeparately()) {
                $this->setTemplate('paybybill/info/invoice_separate_'.strtolower($lang).'.phtml');
        }
        else {
                $this->setTemplate('paybybill/info/invoice_'.strtolower($lang).'.phtml');
        }

        $html = $this->_toHtml();
        if (empty($html)) {
          // Render default.
          $this->setTemplate('paybybill/info/invoice_no.phtml');
          $html = $this->_toHtml();
        }
        return $html;
    }

    public function getPartpayment($lang=null)
    {
        if (!$lang) {
          $lang = $this->getLanguageCode();
        }

        $this->setPartpaymentLateFee(Mage::getStoreConfig('payment/pbbpartpay/partpayment_late_fee'));

        $this->setTemplate('paybybill/info/partpayment_'.strtolower($lang).'.phtml');
        $html = $this->_toHtml();
        if (empty($html)) {
          // Render default.
          $this->setTemplate('paybybill/info/partpayment_no.phtml');
          $html = $this->_toHtml();
        }
        return $html;
    }

    /**
     * Render as PDF
     * @return string
     */
    public function toPdf()
    {
        $this->setIsSecureMode(false);
        $this->setTemplate('paybybill/info/pdf.phtml');
        return $this->toHtml();
    }

    /**
     * Render the value as an array
     *
     * @param mixed $value
     * @param bool $escapeHtml
     * @return $array
     */
    public function getValueAsArray($value, $escapeHtml = false)
    {
        if (empty($value)) {
            return array();
        }
        if (!is_array($value)) {
            $value = array($value);
        }
        if ($escapeHtml) {
            foreach ($value as $_key => $_val) {
                $value[$_key] = $this->escapeHtml($_val);
            }
        }
        return $value;
    }

    /**
     * Getter for children PDF, as array. Analogue of $this->getChildHtml()
     *
     * Children must have toPdf() callable
     * Known issue: not sorted
     * @return array
     */
    public function getChildPdfAsArray()
    {
        $result = array();
        foreach ($this->getChild() as $child) {
            if (is_callable(array($child, 'toPdf'))) {
                $result[] = $child->toPdf();
            }
        }
        return $result;
    }

    /**
     * Returns true of invoice is set to be sent separately.
     * @return bool
     */
    protected function invoiceSentSeparately() {
        // Paper/Email
        $distributionType = Mage::getStoreConfig('payment/pbbinvoice/distribution_type');
        // Company/Client
        $distributionBy = Mage::getStoreConfig('payment/pbbinvoice/distribution_by');

        return $distributionBy == "Company";
    }
}

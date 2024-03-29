<?php

class Trollweb_Paybybill_Model_Payment_Gothia extends Mage_Payment_Model_Method_Abstract
{

    protected $_formBlockType = 'paybybill/form';
    protected $_infoBlockType = 'paybybill/info';

    /**
     * Payment Method features
     * @var bool
     */
    protected $_canAuthorize                = true;
    protected $_canCapture                  = true;
    protected $_canCapturePartial           = true;
    protected $_canRefund                   = true;
    protected $_canRefundInvoicePartial     = false;

//    protected $_isInitializeNeeded          = false; // Maybe this is needed keeping it for now
//    protected $_canFetchTransactionInfo     = false;
    protected $_canManageRecurringProfiles  = false;


    public function validate()
    {
      /*if (!$this->getCheckout()->getPayByBillApproved() && $this->getCheckout()->getQuote()->getBillingAddress()->getCountryId() != "DE") {
        Mage::throwException(Mage::helper('paybybill')->__('You have to verify you credit by clicking the "Check credit"-button before you can continue.'));
      }*/

      return $this;
    }

    /**
     * Global authorize method for PBB service
     * @param Varien_Object $payment Payment object
     * @param $amount Amount
     */
    public function authorize(Varien_Object $payment, $amount)
    {
      // We're doing this here now instead of in CustomerController because we want to jettison
      // the javascript-based all-over-the-place-style validation.
      $paymentMethodFormData = Mage::app()->getRequest()->getPost('payment', array());
      $customer = Mage::getModel('paybybill/payment_api_customer');
      $customer->setMethod($paymentMethodFormData['method']);
      $customer->extractFromQuote($this->getCheckout()->getQuote());
      $customer->extractFromForm($paymentMethodFormData, $paymentMethodFormData['method']);
      $customer->setDistributionBy($this->getConfigData('distribution_by', $payment->getOrder()->getStoreId()));
      $customer->setDistributionType($this->getConfigData('distribution_type', $payment->getOrder()->getStoreId()));
      $creditResult = $customer->checkCredit();
      if($payment->getOrder()->getCustomerId()) {
        $customer->setCustNo($payment->getOrder()->getCustomerId());
      }

      // Throw exception if customer has an error message set
      if ($customer->getErrorMessage()) {
          Mage::throwException($customer->getErrorMessage());
      }

      // This only works because of Trollweb_Paybybill_Model_Payment_Api_Customer::checkCredit()
      // being called above (or in CustomerController).
      $pbbData = $this->getCheckout()->getPayByBillCustomerData();
      if (!$creditResult || !isset($pbbData['cust_no']) || empty($pbbData['cust_no'])) {
          Mage::throwException(Mage::helper('paybybill')->__('Kunne ikke finne kredittinformasjon. Sjekk at personnummer og adressen er riktig'));
      }
      $order = $payment->getOrder();

      $accountOffer = ($this->getCheckout()->getPayByBillPartPaymentAccepted() ? true : false);

      if ($order->getBillingAddress()->getCountryId() == "DE") {
        $gothiaCustomer = Mage::getModel('paybybill/payment_api_customer');
        $gothiaCustomer->setMethod($this->_code);
        $gothiaCustomer->setStoreId($order->getStoreId());
        $gothiaCustomer->extractFromOrder($order);
        $gothiaCustomer->extractFromForm($this->getCheckout()->getPayByBillFormData(),$this->_code);
        $gothiaCustomer->setBirthDate(Mage::helper('paybybill/validate')->dob($order->getCustomerDob()));
        $gothiaCustomer->setDistributionBy($this->getConfigData('distribution_by',$order->getStoreId()));
        $gothiaCustomer->setDistributionType($this->getConfigData('distribution_type',$order->getStoreId()));
        if ($order->getCustomerId()) {
           $gothiaCustomer->setCustNo($order->getCustomerId());
        }
        if (!$gothiaCustomer->validate()) {
          $this->_clearData();
          Mage::throwException($gothiaCustomer->getErrorMessage());
        }

        $result = Mage::helper('paybybill/api')->setStoreId($order->getStoreId())->CheckCustomerAndPlaceReservation($gothiaCustomer,$order->getIncrementId(),$amount, $accountOffer);
        $pbbData = $gothiaCustomer->getData();
        if (!$result['error']) {
          if (isset($result['data']['cust_no'])) {
            $pbbData['cust_no'] = $result['data']['cust_no'];
          }
          if (isset($result['data']['rating'])) {
            $pbbData['rating'] = $result['data']['rating'];
          }
        }
      }
      else {
        $result = Mage::helper('paybybill/api')->setStoreId($order->getStoreId())->PlaceReservation($this->_code,$pbbData['cust_no'],$amount,$order->getBaseCurrencyCode(),$order->getIncrementId(),$accountOffer);
      }

      if (!$result['error'] && isset($result['data']['customerdata'])) {
        $pbbData['customerdata'] = $result['data']['customerdata'];
      }

      if ($result['error']) {
        $this->_clearData();
        Mage::throwException(Mage::helper('paybybill')->__('Unable to place reservation'));
        return false;
      }

      if ($order->getBillingAddress()->getCountryId() != "DE") {
        // Set shipping and billing to customer
        $country = $order->getBillingAddress()->getCountryId();
        $this->updateAddressData($order->getShippingAddress(),$pbbData['customerdata'], $country);
        $this->updateAddressData($order->getBillingAddress(),$pbbData['customerdata'], $country);
      }

      $payment->setTransactionId($result['data']['reservation_id']);
      $pbbOrderData = Mage::getModel('paybybill/orderdata');
      $pbbOrderData->addData($pbbData);
      $pbbOrderData->setOrderId($order->getIncrementId());
      $pbbOrderData->setReservationId($result['data']['reservation_id']);
      $pbbOrderData->setInvoiceFee($this->getInvoiceFee());
      $pbbOrderData->setInvoiceFeeTax($this->getInvoiceFeeTax($order));
      $pbbOrderData->save();

      $this->_clearData();

      return $this;
    }

    public function updateAddressData($address,$addressData,$country)
    {
      foreach ($addressData as $key => $value) {
        switch($key) {
          case 'firstname':   $address->setFirstname($value); break;
          case 'lastname':    $address->setLastname($value); break;
          case 'address':
                if($country == "NO" && !$value) {
                        $address->setStreet(".");
                }
                else {
                        $address->setStreet($value);
                }
                break;
          case 'postalcode':  $address->setPostcode($value); break;
          case 'postalplace': $address->setCity($value); break;
        }
      }
      $address->save();
    }

    public function insertInvoice($invoice)
    {

      if ($this->getConfigData('external_erp',$invoice->getOrder()->getStoreId())) {
        return true;
      }

      $invoiceData = Mage::getModel('paybybill/invoicedata')->loadByInvoiceId($invoice->getIncrementId());

      if ($invoiceData->isObjectNew()) {

        try {
          $orderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($invoice->getOrder()->getIncrementId());

          $invoiceRequest = Mage::getModel('paybybill/payment_api_invoice');
          $invoiceRequest->setInvoice($invoice);
          $invoiceRequest->setInvoiceProfileNo($this->getConfigData('invoice_profile',$invoice->getOrder()->getStoreId()));
          $invoiceRequest->setOrderData($orderData);
          $_dueDate = $this->getDueDate($invoice->getOrder()->getStoreId());
          if ($_dueDate)
          {
            $invoiceRequest->setDueDate($_dueDate);
          }

          $result = Mage::helper('paybybill/api')->setStoreId($invoice->getStoreId())->InsertInvoice($this->_code,$invoiceRequest);

        } catch(Exception $e) {
          Mage::throwException(Mage::helper('paybybill')->__('Unable to create invoice').' '.$e->getMessage());
        }

        if ($result['error']) {
          Mage::throwException(Mage::helper('paybybill')->__('Unable to create invoice').' '.$result['message']);
        }
        else {
          $payment = $invoice->getOrder()->getPayment();
          $payment->setTransactionId($result['data']['transaction_id']);
          $transaction = $payment->addTransaction(Mage_Sales_Model_Order_Payment_Transaction::TYPE_CAPTURE,$invoice);

          $invoiceData->setKid($result['data']['kid']);
          $invoiceData->setTransactionId($result['data']['transaction_id']);
          if(!$orderData->getInvoiceFeeInvoiced() || $orderData->getInvoiceFeeInvoiced() == 0) {
            // Add invoice fee to first Invoice
            $invoiceData->setInvoiceFee($orderData->getInvoiceFee());
            $invoiceData->setInvoiceFeeTax($orderData->getInvoiceFeeTax());

            $orderData->setInvoiceFeeInvoiced($orderData->getInvoiceFee());
            $orderData->setInvoiceFeeTaxInvoiced($orderData->getInvoiceFeeTax());
            $orderData->save();
          }

          $invoiceData->save();

          $transaction->save();
          $invoice->setTransactionId($invoiceData->getTransactionId());
          $invoice->save();
        }
      }

    }


    /**
     * Performs online refunds.
     * @param Varien_Object $payment
     * @param $amount
     */
    public function refund(Varien_Object $payment, $amount) {
        $creditmemo = $payment->getCreditmemo();
        $order = $payment->getOrder();

        try {
            $orderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($order->getIncrementId());

            $creditMemoRequest = Mage::getModel('paybybill/payment_api_invoice');
            $creditMemoRequest->setCreditMemo($creditmemo);
            $creditMemoRequest->setInvoiceProfileNo($this->getConfigData('invoice_profile',$order->getStoreId()));
            $creditMemoRequest->setOrderData($orderData);

            $result = Mage::helper('paybybill/api')->setStoreId($order->getStoreId())->InsertInvoice($this->_code,$creditMemoRequest);

            if ($result['error']) {
                Mage::throwException(Mage::helper('paybybill')->__('Unable to create creditmemo').' '.$result['message']);
            }
            else {
                $creditmemo->setTransactionId($result['data']['transaction_id'])->save();
                $payment = $order->getPayment();
                $payment->setTransactionId($result['data']['transaction_id']);
                $transaction = $payment->addTransaction(Mage_Sales_Model_Order_Payment_Transaction::TYPE_REFUND,$creditmemo);
                $transaction->save();
            }
        }
        catch(Exception $e) {
            Mage::throwException(Mage::helper('paybybill')->__('Unable to create creditmemo').' '.$e->getMessage());
        }

        return $this;
    }

    public function insertCreditMemo($creditMemo)
    {
        if ($this->getConfigData('external_erp',$creditMemo->getOrder()->getStoreId())) {
          return true;
        }

        try {
          $orderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($creditMemo->getOrder()->getIncrementId());

          $creditMemoRequest = Mage::getModel('paybybill/payment_api_invoice');
          $creditMemoRequest->setCreditMemo($creditMemo);
          $creditMemoRequest->setInvoiceProfileNo($this->getConfigData('invoice_profile',$creditMemo->getOrder()->getStoreId()));
          $creditMemoRequest->setOrderData($orderData);

          $result = Mage::helper('paybybill/api')->setStoreId($creditMemo->getStoreId())->InsertInvoice($this->_code,$creditMemoRequest);

          if ($result['error']) {
            Mage::throwException(Mage::helper('paybybill')->__('Unable to create creditmemo').' '.$result['message']);
          }
          else {
            $creditMemo->setTransactionId($result['data']['transaction_id'])->save();
            $payment = $creditMemo->getOrder()->getPayment();
            $payment->setTransactionId($result['data']['transaction_id']);
            $transaction = $payment->addTransaction(Mage_Sales_Model_Order_Payment_Transaction::TYPE_REFUND,$creditMemo);
            $transaction->save();
          }

        } catch(Exception $e) {
          Mage::throwException(Mage::helper('paybybill')->__('Unable to create creditmemo').' '.$e->getMessage());
        }
    }

    public function cancelOrder($order)
    {
      try {
        $orderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($order->getIncrementId());

        $result = Mage::helper('paybybill/api')->setStoreId($order->getStoreId())->CancelReservation($this->_code,$orderData['cust_no'],$order->getIncrementId());


        if ($result['error']) {
          Mage::getSingleton('adminhtml/session')->addError(Mage::helper('paybybill')->__('Unable to cancel reservation. Check PayByBill backend manually.'));
          return false;
        }

      } catch(Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('paybybill')->__('Unable to cancel reservation. Check PayByBill backend manually.').' '.$e->getMessage());
      }

    }


    public function getInvoiceFee()
    {
      return $this->getConfigData('invoice_fee');
    }

    public function getInvoiceFeeTax($order)
    {
      $store = $order->getStore();
      $custTaxClassId = $order->getCustomerTaxClassId();

      $taxCalculationModel = Mage::getSingleton('tax/calculation');
      /* @var $taxCalculationModel Mage_Tax_Model_Calculation */
      $request = $taxCalculationModel->getRateRequest($order->getShippingAddress(), $order->getBillingAddress(), $custTaxClassId, $store);
      $shippingTaxClass = $this->getTaxClass();

      $feeTax      = 0;

      if ($shippingTaxClass) {
          if ($rate = $taxCalculationModel->getRate($request->setProductClassId($shippingTaxClass))) {
            $feeTax = ($this->getInvoiceFee() / ($rate+100))*$rate;
            $feeTax = $store->roundPrice($feeTax);
          }
      }

      return $feeTax;
    }


    public function getTaxClass()
    {
      return $this->getConfigData('invoice_fee_tax_class');
    }

    /**
     * Get checkout session namespace
     *
     * @return Mage_Checkout_Model_Session
     */
    protected function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    protected function _clearData()
    {
      $this->getCheckout()->unsetData('pay_by_bill_approved');
      $this->getCheckout()->unsetData('pay_by_bill_customer_data');
    }

    protected function getDueDate($storeId=null)
    {
      return false;
    }


}

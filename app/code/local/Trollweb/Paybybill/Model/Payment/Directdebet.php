<?php

class Trollweb_Paybybill_Model_Payment_Directdebet extends Trollweb_Paybybill_Model_Payment_Gothia
{

    protected $_code = 'pbbdirect';
    protected $_formBlockType = 'paybybill/formdd';


    public function assignData($data)
    {
      $pbbData = $this->getCheckout()->getPayByBillCustomerData();
      $pbbData['bank_id'] = $data->getDdBankid();
      $pbbData['bank_account'] = $data->getDdBankaccount();
      //$pbbData['ss_number'] = Mage::helper('paybybill/validate')->birthday($data->getPbbdirectBirthNumber());
      $pbbData['cust_no'] = '';
      $this->getCheckout()->setPayByBillFormData($data->getData());
      $this->getCheckout()->setPayByBillCustomerData($pbbData);
      $this->getCheckout()->setPayByBillApproved(true);
    }

    public function validate()
    {
      parent::validate();

      $pbbData = $this->getCheckout()->getPayByBillCustomerData();

      // Check if things are approved
      if (empty($pbbData['bank_id']) || empty($pbbData['bank_account'])) {
        Mage::throwException(Mage::helper('paybybill')->__('You need to enter your bank account and bank id'));
      }

      if (!preg_match("/^[0-9]{8}$/",$pbbData['bank_id'])) {
        Mage::throwException(Mage::helper('paybybill')->__('The Bank ID has to be 8 digits.'));
      }

    }

    public function authorize(Varien_Object $payment, $amount)
    {
      $order = $payment->getOrder();

      if ($order->getBillingAddress()->getCountryId() != "DE") {
        Mage::throwException(Mage::helper('paybybill')->__('This payment method is only available in Germany'));
      }

      $pbbData = $this->getCheckout()->getPayByBillCustomerData();

      $accountOffer = false;

      $gothiaCustomer = Mage::getModel('paybybill/payment_api_customer');
      $gothiaCustomer->setMethod($this->_code);
      $gothiaCustomer->setStoreId($order->getStoreId());
      $gothiaCustomer->extractFromOrder($order);
      $gothiaCustomer->extractFromForm($this->getCheckout()->getPayByBillFormData(),$this->_code);
      $birthDay = Mage::helper('paybybill/validate')->dob($order->getCustomerDob());
      $gothiaCustomer->setSsNumber(Mage::helper('paybybill/validate')->birthday($birthDay));
      $gothiaCustomer->setCustNo($pbbData['cust_no']); // Customer number
      $gothiaCustomer->setBankId($pbbData['bank_id']);
      $gothiaCustomer->setBankAccount($pbbData['bank_account']);
      $gothiaCustomer->setDistributionBy($this->getConfigData('distribution_by'));
      $gothiaCustomer->setDistributionType($this->getConfigData('distribution_type'));

      if ($order->getCustomerId()) {
         $gothiaCustomer->setCustNo($order->getCustomerId());
      }

      $result = Mage::helper('paybybill/api')->setStoreId($order->getStoreId())->CheckCustomerAndPlaceReservation($gothiaCustomer,$order->getIncrementId(),$amount, $accountOffer);

      if ($result['error']) {
        $this->_clearData();
        Mage::throwException(Mage::helper('paybybill')->__('Unable to place reservation'));
        return false;
      }

      $pbbData = $gothiaCustomer->getData();
      if (isset($result['data']['cust_no'])) {
        $pbbData['cust_no'] = $result['data']['cust_no'];
      }
      if (isset($result['data']['rating'])) {
        $pbbData['rating'] = $result['data']['rating'];
      }

      // Set shipping and billing to customer
     // $this->updateAddressData($order->getShippingAddress(),$pbbData['customerdata']);
     // $this->updateAddressData($order->getBillingAddress(),$pbbData['customerdata']);

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

    protected function getDueDate($storeId=null)
    {
      return 1;
    }


}
<?php

class Trollweb_Paybybill_Model_Payment_Quote_Total extends Mage_Sales_Model_Quote_Address_Total_Abstract {

    protected $_code = 'pbbinvoicefee';
    protected $_pbbMethods = array('pbbinvoice','pbbpartpay');

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        if ($address->getAddressType() != "shipping")
        {
          return $this;
        }

        $paymentMethod = Mage::app()->getFrontController()->getRequest()->getParam('payment');
        $paymentMethod = Mage::app()->getStore()->isAdmin() && isset($paymentMethod['method']) ? $paymentMethod['method'] : null;
        if (!in_array($paymentMethod,$this->_pbbMethods) && (!count($address->getQuote()->getPaymentsCollection()) || !$address->getQuote()->getPayment()->hasMethodInstance())){
            return $this;
        }

        $paymentMethod = $address->getQuote()->getPayment()->getMethodInstance();

        if (!in_array($paymentMethod->getCode(),$this->_pbbMethods)) {
            return $this;
        }


        $fee = $paymentMethod->getInvoiceFee();
        $store = $address->getQuote()->getStore();

        $address->setPayByBillInvoiceFee($store->convertPrice($fee,false));
        $address->setBasePayByBillInvoiceFee($fee);


        $address->setBaseGrandTotal($address->getBaseGrandTotal()+$fee);
        $address->setGrandTotal($address->getGrandTotal()+$store->convertPrice($fee, false));

        return $address;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {

        if ($address->getAddressType() != "shipping") {
          return $this;
        }

        $amount = $address->getPayByBillInvoiceFee();



        if ($amount!=0) {
            $address->addTotal(array(
                'code' => $this->getCode(),
                'title' => Mage::helper('paybybill')->__('PayByBill Invoice Fee'),
                'value' => $amount,
            ));
        }
        return $this;
    }

    protected function getCheckout() {
      return Mage::getSingleton('checkout/session');
    }

 }

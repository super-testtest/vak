<?php

class Trollweb_Paybybill_Model_Payment_Quote_Tax extends Mage_Sales_Model_Quote_Address_Total_Tax {

    protected $_pbbMethods = array('pbbinvoice','pbbpartpay');

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {

        if (!$address->getQuote()->getId()) {
          return $this;
        }

        if ($address->getAddressType() != "shipping") {
          return $address;
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

        $store = $address->getQuote()->getStore();
        $custTaxClassId = $address->getQuote()->getCustomerTaxClassId();

        $taxCalculationModel = Mage::getSingleton('tax/calculation');
        /* @var $taxCalculationModel Mage_Tax_Model_Calculation */
        $request = $taxCalculationModel->getRateRequest($address, $address->getQuote()->getBillingAddress(), $custTaxClassId, $store);
        $shippingTaxClass = (int)$paymentMethod->getTaxClass();

        $feeTax      = 0;
        $feeBaseTax  = 0;

        if ($shippingTaxClass) {
            if ($rate = $taxCalculationModel->getRate($request->setProductClassId($shippingTaxClass))) {
              $feeTax = ($address->getPayByBillInvoiceFee() / ($rate+100))*$rate;
              $feeBaseTax= ($address->getBasePayByBillInvoiceFee() / ($rate+100))*$rate;
              $feeTax    = $store->roundPrice($feeTax);
              $feeBaseTax= $store->roundPrice($feeBaseTax);

              $address->setTaxAmount($address->getTaxAmount() + $feeTax);
              $address->setBaseTaxAmount($address->getBaseTaxAmount() + $feeBaseTax);

              $this->_saveAppliedTaxes(
                  $address,
                  $taxCalculationModel->getAppliedRates($request),
                  $feeTax,
                  $feeBaseTax,
                  $rate
              );

            }
        }

        $address->setGrandTotal($address->getGrandTotal());
        $address->setBaseGrandTotal($address->getBaseGrandTotal());

        return $address;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        return $this;
    }

    protected function getCheckout() {
      return Mage::getSingleton('checkout/session');
    }

 }

<?php
/**
 * Invoice fee address quote
 *
 * PHP Version 5.3
 *
 * @category Payment
 * @package  Klarna_Module_Magento
 * @author   MS Dev <ms.modules@klarna.com>
 * @license  http://opensource.org/licenses/BSD-2-Clause BSD2
 * @link     http://integration.klarna.com
 */

/**
 * Class to handle the invoice fee  on a address quote
 *
 * @category Payment
 * @package  Klarna_Module_Magento
 * @author   MS Dev <ms.modules@klarna.com>
 * @license  http://opensource.org/licenses/BSD-2-Clause BSD2
 * @link     http://integration.klarna.com
 */
class Klarna_KlarnaPaymentModule_Model_Quote_Total
    extends Mage_Sales_Model_Quote_Address_Total_Abstract
{

    protected $address;

    protected $paymentMethod;

    /**
     * Collect the order total
     *
     * @param object $address The address instance to collect from
     *
     * @return Klarna_KlarnaPaymentModule_Model_Quote_Total
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        if ($address->getAddressType() != "shipping") {
            return $this;
        }

        $this->address = $address;
        $this->_resetValues();

        if ($this->address->getQuote()->getId() == null) {
            return $this;
        }

        $items = $this->address->getAllItems();
        if (!count($items)) {
            return $this;
        }

        $payment = $this->address->getQuote()->getPayment();

        try {
            /**
             * Instead of relying on hasMethodInstance which would not always
             * work when i.e the order total is reloaded with coupon codes, we
             * try to get the instance directly instead.
             */
            $this->paymentMethod = $payment->getMethodInstance();
        } catch (Mage_Core_Exception $e) {
            return $this;
        }

        if (!$this->paymentMethod instanceof Mage_Payment_Model_Method_Abstract) {
            return $this;
        }

        if ($this->paymentMethod->getCode() === 'klarna_invoice') {
            $this->_initInvoiceFee();
        }

        return $this;

    }

    /**
     * Reset the invoice fee variables
     *
     * @return void
     */
    private function _resetValues()
    {
        $this->address->setInvoiceFee(0);
        $this->address->setBaseInvoiceFee(0);
        $this->address->setInvoiceFeeExcludedVat(0);
        $this->address->setBaseInvoiceFeeExcludedVat(0);
        $this->address->setInvoiceTaxAmount(0);
        $this->address->setBaseInvoiceTaxAmount(0);
        $this->address->setInvoiceFeeRate(0);
    }

    /**
     * Initialize the invoice fee variables on the address instance
     *
     * @return void
     */
    private function _initInvoiceFee()
    {
        $fee = $this->paymentMethod->getAddressInvoiceFee($this->address);
        $this->address->setBaseInvoiceFee($fee['base_incl']);
        $this->address->setInvoiceFee($fee['incl']);
        $this->address->setBaseInvoiceFeeExcludedVat($fee['base_excl']);
        $this->address->setInvoiceFeeExcludedVat($fee['excl']);
        $this->address->setBaseInvoiceTaxAmount($fee['base_taxamount']);
        $this->address->setInvoiceTaxAmount($fee['taxamount']);
        $this->address->setInvoiceFeeRate($fee['rate']);

        // Add our invoice fee to the address totals
        $this->address->setBaseGrandTotal(
            $this->address->getBaseGrandTotal() + $fee['base_incl']
        );
        $this->address->setGrandTotal(
            $this->address->getGrandTotal() + $fee['incl']
        );
    }

    /**
     * Add invoice fee total information to address
     *
     * @param object $address The address instance
     *
     * @return Klarna_KlarnaPaymentModule_Model_Quote_Total
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        if ($address->getAddressType() != "shipping") {
            return $this;
        }

        $excl = $address->getInvoiceFeeExcludedVat();
        $incl = $address->getInvoiceFee();

        $data = Mage::helper("klarnaPaymentModule");
        if ($data->isOneStepCheckout()) {
            $value = (($data->isOneStepCheckoutTaxIncluded()) ? $incl : $excl);
        } else {
            $value = $incl;
        }

        if ($value == 0) {
            return $this;
        }

        $storeId = Mage::app()->getStore()->getId();
        Mage::helper("klarnaPaymentModule/api")->loadConfig($storeId);
        $country = $address->getCountry();
        $locale = Mage::helper('klarnaPaymentModule/lang')->createLocale($country);
        $translator = KiTT::translator($locale);

        $address->addTotal(
            array(
                'code' => $this->getCode(),
                'title' => $translator->translate('ot_klarna_title'),
                'value' => $value
            )
        );

        return $this;
    }

}

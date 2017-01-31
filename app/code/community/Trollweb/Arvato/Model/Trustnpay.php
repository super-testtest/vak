<?php
class Trollweb_Arvato_Model_Trustnpay extends Mage_Payment_Model_Method_Abstract {

    protected $_code  = 'arvato_trustnpay';

    protected $_formBlockType = 'arvato/trustnpay_form';
    protected $_infoBlockType = 'arvato/trustnpay_info';

    protected $_canAuthorize            = true;
    protected $_canCapture              = false;
    protected $_canCapturePartial       = false;
    protected $_canRefund               = false;
    protected $_canRefundInvoicePartial = false;
    protected $_canVoid                 = false;
    protected $_canUseInternal          = true;
    protected $_canUseCheckout          = true;
    protected $_canUseForMultishipping  = false;
    protected $_isInitializeNeeded      = false;
    protected $_debugReplacePrivateDataKeys = array();
   
    public function validate() {

    }

    public function authorize(Varien_Object $payment, $amount) {
        $paymentInfo = $this->getInfoInstance();
        $order = $paymentInfo->getOrder();
        if (!$order OR !$order->getId()) {
            return $this;
        }

        $apiPreCheck = Mage::getModel('arvato/api_precheck');
        $apiPreCheck->setPayment($paymentInfo);

        $preCheckResult = $apiPreCheck->request();
        $this->debugData('PreCheckCustomer formated result:');
        $this->debugData($preCheckResult);

        if (!$preCheckResult['success']) {
            Mage::throwException($preCheckResult['message']);
            return $this;
        }
        
        if ($preCheckResult['success']) {
            $apiCompleteCheckout = Mage::getModel('arvato/api_complete');
            $completeResult = $apiCompleteCheckout->setPreCheckResult($preCheckResult)
                ->setPayment($paymentInfo)
                ->request();
            $this->debugData('CompleteCheckout formated result:');
            $this->debugData($completeResult);

            if (!$completeResult['success']) {
                Mage::throwException($completeResult['message']);
                return $this;
            }

            if ($completeResult['is_approved']) {
                if ($this->getConfigData('overwrite_billing_address')) {
                    $billingAddress = $order->getBillingAddress();
                    $billingAddress->addData($preCheckResult['address']);
                    $billingAddress->save();
                }
                if ($this->getConfigData('overwrite_shipping_address') AND !$order->getIsVirtual()) {
                    $shippingAddress = $order->getShippingAddress();
                    $shippingAddress->addData($preCheckResult['address']);
                    $shippingAddress->save();
                }

                $payment->setAdditionalInformation($this->_code . '_trans_id', $preCheckResult['trans_id']);
                $payment->setAdditionalInformation($this->_code . '_checkout_id', $preCheckResult['checkout_id']);
                $payment->setAdditionalInformation($this->_code . '_customer_no', $preCheckResult['customer_no']);
                $payment->addTransaction(Mage_Sales_Model_Order_Payment_Transaction::TYPE_AUTH);
                $payment->setTransactionId($completeResult['reservation_id']);
                Mage::getModel('sales/quote')
                    ->load($order->getQuoteId())
                    ->setIsActive(false)
                    ->save();
            }
        }

        return $this;
    }

    public function capture(Varien_Object $payment, $amount) {
    
    }

    public function void(Varien_Object $payment) {

    }

    public function refund(Varien_Object $payment, $amount) {

    }

    public function initialize($paymentAction, $stateObject) {

    }

    public function getLogo() {
        return $this->getConfigData('logo');
    }

    public function getInfoText() {
        return $this->getConfigData('info_text');
    }
}

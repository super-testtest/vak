<?php
class Trollweb_Arvato_Model_Api_Complete extends Trollweb_Arvato_Model_Api {
    public function request() {
        try {
            $soapClient = $this->getClient();
            $result =  $soapClient->__call('CompleteCheckout', $this->buildComplete());
            $this->debugData('CompleteCheckout result:');
            $this->debugData($result);
            $response = $this->response($result);
            return $response;
        }
        catch (Exception $e) {
            $this->debugData('CompleteCheckout exception:');
            $this->debugData($e->getMessage());
            return array(
                'success' => 0,
                'message' => Mage::helper('arvato')->__('Unable to create TrustnPay order, please try again later or use different payment method.'),
            );
        }
    }

    public function response($result) {
        $response = array();
        $response['success'] = $result->IsApproved ? 1 : 0;
        $response['reservation_id'] = $result->ReservationID;
        $response['is_approved'] = $result->IsApproved;
        $response['result_text'] = @$result->ResultText;
        $response['result_code'] = $result->ResultCode;

        return $response;
    }

    public function buildComplete() {
        $preCheck = $this->getPreCheckResult();
        $payment = $this->getPayment();
        $order = $payment->getOrder();

        $params = array();
        $params['User'] = $this->buildUser();
        $params['CheckoutID'] = $preCheck['checkout_id'];
        $params['OrderNo'] = $order->getIncrementId();
        $params['OrderDate'] = time($order->getCreatedAt());
        $params['CustomerNo'] = $preCheck['customer_no'];
        $params['CurrencyCode'] = $order->getBaseCurrencyCode();
        $params['Amount'] = $order->getBaseGrandTotal();
        $params['TotalOrderValue'] = $order->getBaseGrandTotal();
        $params['PaymentInfo'] = array(
            'PaymentMethod' => 'Invoice',
        );
        
        return array('CompleteCheckoutRequest' => $params);
    }
}

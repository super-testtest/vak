<?php
class Trollweb_Arvato_Model_Api_Precheck extends Trollweb_Arvato_Model_Api {
    public function request() {
        try {
            $soapClient = $this->getClient();
            $this->debugData('PreCheckCustomer request:');
            $this->debugData($this->buildPreCheck());
            $result =  $soapClient->__call('PreCheckCustomer', $this->buildPreCheck());
            $this->debugData('PreCheckCustomer result:');
            $this->debugData($result);
            $response = $this->response($result);
            return $response;
        }
        catch (Exception $e) {
            $this->debugData('PreCheckCustomer exception:');
            $this->debugData($e->getMessage());
            return array(
                'success' => 0,
                'message' => Mage::helper('arvato')->__('Unable to run credit check, please try again later or use different payment method.'),
            );
        }
    }

    public function response($result) {
        $allowInvoice = false;
        if ($methods = $result->AllowedPaymentMethods) {
            if ($method = (array)@$methods->AllowedPaymentMethod) {
                foreach ($method as $item) {
                    if ($item->PaymentMethod == 'Invoice') {
                        $allowInvoice = true;
                        break;
                    }
                }
            }
        }

        $customer = @$result->Customer ? @$result->Customer : false;
        $customerNo = @$customer->CustomerNo ? @$customer->CustomerNo : false;
        $customerAddress = @$customer->Address ? @$customer->Address : false;

        $response = array();
        $response['success'] = @$result->IsSuccess ? 1 : 0;
        $response['trans_id'] = @$result->TransactionID;
        $response['checkout_id'] = @$result->CheckoutID;
        $response['customer_no'] = $customerNo;
        $response['outcome'] = @$result->Outcome == 'Accepted' ? 1 : 0;
        $response['allow_invoice'] = $allowInvoice;
        $response['address'] = array(
            'firstname' => @$customer->FirstName,
            'lastname' => @$customer->LastName,
            'street' => @$customerAddress->Street . ' ' . @$customerAddress->StreetNumber,
            'postcode' => @$customerAddress->PostalCode,
            'city' => @$customerAddress->PostalPlace,
            'country_id' => Mage::helper('arvato')->getCountryIdByNo(@$customerAddress->CountryCode),
        );

        if (@$result->Outcome != 'Accepted') {
            $response['message'] = Mage::helper('arvato')->__('Your payment request was declined, please use different payment method.');
        }

        return $response;
    }

    public function buildPreCheck() {
        $payment = $this->getPayment();
        $order = $payment->getOrder();
        $billingAddress = $order->getBillingAddress();
        $shippingAddress = $order->getShippingAddress();

        $params = array();
        $params['User'] = $this->buildUser();
        $params['Customer'] = $this->buildCustomer($billingAddress); 
        $params['DeliveryCustomer'] = $this->buildCustomer($shippingAddress);
        $params['OrderDetails'] = array(
            'Amount' => $order->getBaseGrandTotal(),
            'CurrencyCode' => 'EUR', //$order->getCurrencyId(),
            'OrderNo' => $order->getIncrementId(),
            'OrderChannelType' => 'Internet',
            'TotalOrderValue' => $order->getBaseGrandTotal(),
            'OrderLines' => $this->buildOrderLines($order->getAllItems()),
        );
        //$params['Organization_PersonalNo'] = $payment->getTnpSnn();
        return array('PreCheckCustomerRequest' => $params);
    }

    public function buildOrderLines($items) {
        $lines = array();
        foreach ($items as $item) {
            if ($item->getProductType() != 'simple') {
                continue;
            }
            $qty = $item->getQtyOrdered();
            $discount = $item->getBaseDiscountAmount();
            $price = ($item->getBaseRowTotalInclTax() - $discount) / $item->getQtyOrdered();
            if ($item->getParentItemId()) {
                $parent = $item->getParentItem();
                $qty = $parent->getQtyOrdered();
                $discount = $parent->getBaseDiscountAmount();
                $price = ($parent->getBaseRowTotalInclTax() - $discount) / $parent->getQtyOrdered();
            }
            $lines[] = array(
                'ItemID' => $item->getSku(),
                'ItemDescription' => $item->getName(),
                'Quantity' => $qty,
                'UnitPrice' => $price,
                'VatPercent' => $item->getTaxPercent(),
            );
        }
        return $lines;
    }
}

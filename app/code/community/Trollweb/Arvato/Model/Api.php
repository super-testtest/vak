<?php
class Trollweb_Arvato_Model_Api extends Trollweb_Arvato_Model_Trustnpay {
    protected $_soapClient = null;

    const WSDL_TEST = 'https://sandboxapi.horizonafs.com/eCommerceServices/eCommerce/Checkout/v1/CheckoutServices.svc?singleWsdl';
    const WSDL_PROD = 'https://sandboxapi.horizonafs.com/eCommerceServices/eCommerce/Checkout/v1/CheckoutServices.svc?singleWsdl';

    public function getClient() {
        if (!$this->_soapClient) {
            $wsdl = $this->getWsdlUrl();
            $this->_soapClient = new SoapClient($wsdl, array('encoding' => 'utf-8'));
        }
        return $this->_soapClient;
    }

    public function getWsdlUrl() {
       $test = $this->getConfigData('test');
       if ($test) {
           return self::WSDL_TEST;
       }
       return self::WSDL_PROD;
    }

    public function buildUser() {
        return array(
            'ClientID' => $this->getConfigData('api_client_id'),
            'Password' => $this->getConfigData('api_password'),
            'Username' => $this->getConfigData('api_username'),
        );
    }

    public function buildCustomer($address) {
        return array(
            'Address'       => $this->buildAddress($address),
            'FirstName'     => $address->getFirstname(),
            'LastName'      => $address->getLastname(),
        );
    }

    public function buildAddress($address) {
        return array(
            'CountryCode'   => Mage::helper('arvato')->getCountryNumber($address->getCountryId()),
            'PostalCode'    => $address->getPostcode(),
            'PostalPlace'   => $address->getCity(),
            'Street'        => $address->getStreet(-1),
        );
    }


    public function getConfigData($field, $storeId = null) {
        return Mage::helper('arvato')->getConfigData($field, $storeId);
    }
}

<?php

class Trollweb_Paybybill_Helper_Api
{

	const WSDL = 'gothia.xml';
	const WSDL_DEMO = 'gothia_demo.xml';
	protected $_soapclient;
	protected $_storeid;

	public function __construct()
	{
		if (Mage::getStoreConfig('advanced/paybybill/demo')) {
		 $this->_soapclient = New Zend_Soap_Client_DotNet(Mage::getModuleDir('etc', 'Trollweb_Paybybill').'/'.self::WSDL_DEMO, array('encoding'=>'UTF-8'));
		 $this->_soapclient->setLocation('https://clienttesthorizon.gothiagroup.com/AFSServices/AFSService.svc/basicHttpBinding');
		 
		}
		else {
		 $this->_soapclient = New Zend_Soap_Client_DotNet(Mage::getModuleDir('etc', 'Trollweb_Paybybill').'/'.self::WSDL, array('encoding'=>'UTF-8'));
		 $this->_soapclient->setLocation('https://horizonws.gothiagroup.com/AFSServices/AFSService.svc/basicHttpBinding');
		 // $this->_soapclient->setLocation('https://horizon.gothiagroup.com/AFSServices/AFSService.svc?wsdl');
		 
		}
		$this->_storeid = NULL;
//   $this->_soapclient->setSoapVersion(SOAP_1_2);
	}

	public function CheckCustomer(Trollweb_Paybybill_Model_Payment_Api_Customer $customer)
	{
		$request = array();
		$request['user'] = $this->getUserData($customer->getMethod());
		$request['customer'] = $customer->getRequest();

		$result = array('error' => false);

		$this->rawlog("CheckCustomer REQUEST:\n".print_r($request,true));

		try {
			Mage::log('Request',null,'CreditCheck.log');
			Mage::log($request,null,'CreditCheck.log');
			$data = $this->_soapclient->CheckCustomer($request);
			Mage::log('Response',null,'CreditCheck.log');
			Mage::log($data,null,'CreditCheck.log');
			$this->rawlog(print_r($data,true));

			if ($data->Success && $data->Customer && $data->Customer->CustNo) {
				$result['data'] = array("cust_no" => $data->Customer->CustNo,
																"credit_limit" => $this->GetCustomerLimit($customer->getMethod(), $data->Customer->CustNo), //$data->Customer->CreditLimit,
																"rating" => $data->Customer->Rating,
																"customerdata" => array(
																	"firstname" => $data->Customer->FirstName,
																	"lastname" => $data->Customer->LastName,
																	"address" => $data->Customer->Address,
																	"postalcode" => $data->Customer->PostalCode,
																	"postalplace" => $data->Customer->PostalPlace,
																	"countrycode" => $data->Customer->CountryCode,
																											 ),
															 );
			}
			else {
				$result['error'] = true;
				if ($data->InfoMessages) {
					$result['message'] = $data->InfoMessages->ResponseMessageBase->Message;
				}
				elseif ($data->Errors) {
					if (isset($data->Errors->ResponseMessageBase->Message)) {
						$result['message'] = $data->Errors->ResponseMessageBase->Message;
					}
					else {
						$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
					}
				}
				else {
					$result['message'] = 'An unknown error occured.';
				}
			}
		}
		catch (Exception $e) {

			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}
		return $result;
	}

	public function CheckCustomerAndPlaceReservation(Trollweb_Paybybill_Model_Payment_Api_Customer $customer,$orderno,$amount,$accountoffer=false)
	{
		$request = array();
		$request['user'] = $this->getUserData($customer->getMethod());
		$request['customer'] = $customer->getRequest();
		$request['reservation'] = array(
				'AccountOfferType' => ($accountoffer ? 'AccountOffer': 'NoAccountOffer'),
				'Amount'					 => number_format($amount,2,".",""),
				'CurrencyCode'		 => $customer->getCurrencyCode(),
				'CustomerNo'			 => $customer->getCustNo(),
				'OrderNo'					 => $orderno,
																	 );

		$request['additionalReservationInfo'] = array(
				'DirectDebetBankAccount' => '',
				'DirectDebetBankID'			 => '',
				'PaymentMethod'		       => 'Invoice',
																								 );

		if ($customer->getMethod() == 'pbbdirect') {
			// Direct Debet
			$request['additionalReservationInfo'] = array(
					'DirectDebetBankAccount' => $customer->getBankAccount(),
					'DirectDebetBankID'			 => $customer->getBankId(),
					'PaymentMethod'		       => 'DirectDebet',
																									 );
		}

		$result = array('error' => false);
		$this->rawlog("CheckCustomerAndPlaceReserveration REQUEST:\n".print_r($request,true));

		try {
			$data = $this->_soapclient->CheckCustomerAndPlaceReservation($request);

			$this->rawlog(print_r($data,true));

			if ($data->Success && $data->Customer && $data->Customer->CustNo) {
				$result['data'] = array("cust_no" => $data->Customer->CustNo,
																"reservation_id" => $data->Reservation->ReservationID,
																"rating" => $data->Customer->Rating,
																"customerdata" => array(
																	"firstname" => $data->Customer->FirstName,
																	"lastname" => $data->Customer->LastName,
																	"address" => $data->Customer->Address,
																	"postalcode" => $data->Customer->PostalCode,
																	"postalplace" => $data->Customer->PostalPlace,
																	"countrycode" => $data->Customer->CountryCode,
																											 ),
															 );
			}
			else {
				$result['error'] = true;
				if ($data->InfoMessages) {
					$result['message'] = $data->InfoMessages->ResponseMessageBase->Message;
				}
				elseif ($data->Errors) {
					if ($data->Errors->ResponseMessageBase->Message) {
						$result['message'] = $data->Errors->ResponseMessageBase->Message;
					}
					else {
						$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
					}
				}
				else {
					$result['message'] = 'An unknown error occured.';
				}
			}
		}
		catch (Exception $e) {
			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}

		if ($result['error']) {
			Mage::log('[PBB CheckCustomerAndPlaceReservation] '.$result['message'],Zend_log::ERR);
		}

		return $result;
	}

	public function GetAccountTermsAndConditions($method, $custno)
	{
		$request = array();
		$request['user'] = $this->getUserData($method);
		$request['accountTermsAndConditionsRequest'] = array('CustomerNo' => $custno,);

		$result = array('error' => false);

		try {
			$data = $this->_soapclient->GetAccountTermsAndConditions($request);

			if ($data->Success && $data->AccountTermsAndConditions && $data->AccountTermsAndConditions->AcceptID) {
				$this->rawlog('GetAccountTermsAndConditions RESULT:'.print_r($data,true));
				$result['data'] = array(
						"accept_id" => $data->AccountTermsAndConditions->AcceptID,
						"require_confirmation" => $data->AccountTermsAndConditions->RequireCustomerConfirmation,
						"html" => $data->AccountTermsAndConditions->TermsAndConditions,
															 );
			}
			else {
				$result['error'] = true;
				if ($data->InfoMessages) {
					$result['message'] = $data->InfoMessages->ResponseMessageBase->Message;
				}
				elseif ($data->Errors) {
					if ($data->Errors->ResponseMessageBase->Message) {
						$result['message'] = $data->Errors->ResponseMessageBase->Message;
					}
					else {
						$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
					}
				}
				else {
					$result['message'] = 'An unknown error occured.';
				}
			}
		}
		catch (Exception $e) {
			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}

		if ($result['error']) {
			Mage::log('[PBB] '.$result['message'],Zend_log::ERR);
		}

		return $result;
	}


	public function AcceptAccountTermsAndConditions($method, $acceptid, $custno)
	{
		$request = array();
		$request['user'] = $this->getUserData($method);
		$request['accountTermsAndConditionsRequest'] = array(
					'AcceptID'   => $acceptid,
					'CustomerNo' => $custno,
																												);

		$result = array('error' => false);
		try {
			$data = $this->_soapclient->AcceptAccountTermsAndConditions($request);

			if ($data->Success) {
				$result['data'] = array();
			}
			else {
				$result['error'] = true;
				if ($data->InfoMessages) {
					$result['message'] = $data->InfoMessages->ResponseMessageBase->Message;
				}
				elseif ($data->Errors) {
					if ($data->Errors->ResponseMessageBase->Message) {
						$result['message'] = $data->Errors->ResponseMessageBase->Message;
					}
					else {
						$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
					}
				}
				else {
					$result['message'] = 'An unknown error occured.';
				}
			}
		}
		catch (Exception $e) {
			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}

		if ($result['error']) {
			Mage::log('[PBB] '.$result['message'],Zend_log::ERR);
		}

		return $result;
	}


	public function PlaceReservation($method,$custno,$amount,$currencycode,$ordeno,$accountoffer=false)
	{
		$request = array();
		$request['user'] = $this->getUserData($method);
		$request['reservation'] = array(
				'AccountOfferType' => ($accountoffer ? 'AccountOffer': 'NoAccountOffer'),
				'Amount'					 => number_format($amount,2,".",""),
				'CurrencyCode'		 => $currencycode,
				'CustomerNo'			 => $custno,
				'OrderNo'					 => $ordeno,
																	 );

		$result = array('error' => false);

		try {
			$data = $this->_soapclient->PlaceReservation($request);

			if ($data->Success && $data->Reservation && $data->Reservation->ReservationID) {
				$result['data'] = array("reservation_id" => $data->Reservation->ReservationID);
			}
			else {
				$result['error'] = true;
				if ($data->InfoMessages) {
					$result['message'] = $data->InfoMessages->ResponseMessageBase->Message;
				}
				elseif ($data->Errors) {
					if ($data->Errors->ResponseMessageBase->Message) {
						$result['message'] = $data->Errors->ResponseMessageBase->Message;
					}
					else {
						$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
					}
				}
				else {
					$result['message'] = 'An unknown error occured.';
				}
			}
		}
		catch (Exception $e) {
			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}

		if ($result['error']) {
			Mage::log('[PBB] '.$result['message'],Zend_log::ERR);
		}

		return $result;
	}

	public function CancelReservation($method, $custno, $orderno)
	{
		$request = array();
		$request['user'] = $this->getUserData($method);
		$request['cancelReservation'] = array(
				'CustomerNo'			 => $custno,
				'OrderNo'					 => $orderno,
																	 );

		$result = array('error' => false);

		try {
			$data = $this->_soapclient->CancelReservation($request);

			if ($data->Success) {
				$result['data'] = array();
			}
			else {
				$result['error'] = true;
				if ($data->InfoMessages) {
					$result['message'] = $data->InfoMessages->ResponseMessageBase->Message;
				}
				elseif ($data->Errors) {
					if ($data->Errors->ResponseMessageBase->Message) {
						$result['message'] = $data->Errors->ResponseMessageBase->Message;
					}
					else {
						$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
					}
				}
				else {
					$result['message'] = 'An unknown error occured.';
				}
			}
		}
		catch (Exception $e) {
			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}

		if ($result['error']) {
			Mage::log('[PBB] '.$result['message'],Zend_log::ERR);
		}

		return $result;
	}

	public function InsertInvoice($method, Trollweb_Paybybill_Model_Payment_Api_Invoice $invoiceRequest)
	{
		$request = array();
		$request['user'] = $this->getUserData($method);
		$request['invoice'] = $invoiceRequest->getRequest();

		$result = array('error' => false);


		// Added by Ankit Dobariya

		if(isset($request['invoice']['InvoiceLines']) && count($request['invoice']['InvoiceLines']) > 0){

			for ($i=0; $i < count($request['invoice']['InvoiceLines']); $i++) { 

				if(isset($request['invoice']['InvoiceLines'][$i]['TaxAmount']) && $request['invoice']['InvoiceLines'][$i]['TaxAmount'] != 0){
					$_tax = $request['invoice']['InvoiceLines'][$i]['TaxAmount'];
					$_netAmount = $request['invoice']['InvoiceLines'][$i]['NetAmount'];

					$_tax_persent = ( (float)$_tax * 100 ) / (float)$_netAmount; 
					if(!isset($request['invoice']['InvoiceLines'][$i]['TaxPercent'])){
						$request['invoice']['InvoiceLines'][$i]['TaxPercent'] = $_tax_persent;
					}
				}
			}
		}


		$this->rawlog("InsertInvoice REQUEST:\n".print_r($request,true));
		// $request['invoice']['InvoiceLines']['0']['ItemDescription'] = 'test';


		Mage::log($request,null,'InsertInvoice.log');
		try {
			$data = $this->_soapclient->InsertInvoice($request);

			$this->rawlog(print_r($data,true));

			if ($data->Success) {
				$result['data'] = array(
					'kid' => $data->Invoice->KID,
					'transaction_id' => $data->TransactionID
															 );

				// Just add as a comment ??
				// $data->TransactionID
				// $data->Invoice->KID

			}
			else {
				$result['error'] = true;
				if ($data->InfoMessages) {
					$result['message'] = $data->InfoMessages->ResponseMessageBase->Message;
				}
				elseif ($data->Errors) {
					if ($data->Errors->ResponseMessageBase->Message) {
						$result['message'] = $data->Errors->ResponseMessageBase->Message;
					}
					else {
						$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
					}
				}
				else {
					$result['message'] = 'An unknown error occured.';
				}
			}
		}
		catch (Exception $e) {
			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}

		return $result;
	}


	public function getInvoiceLink($method,$invoiceNo) {
		$request = array();
		$request['user'] = $this->getUserData($method);
		$request['invoiceNo'] = $invoiceNo;

		$this->rawlog("getInvoiceLink REQUEST:".print_r($request,true));
		$result = array('error' => false);

		try {
			Mage::log($request,null,'pbbinvoice.log');
			$data = $this->_soapclient->GetInvoicePrintLink($request);

			$this->rawlog(print_r($data,true));

			if ($data->Success) {
				$result['link'] = $data->ReportLink->ReportLink;
			}
			elseif ($data->Errors) {
				$result['error'] = true;
				if ($data->Errors->ResponseMessageBase->Message) {
					$result['message'] = $data->Errors->ResponseMessageBase->Message;
				}
				else {
					$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
				}
			}
			else {
				$result['error'] = true;
				$result['message'] = 'An unknown error occured.';
			}

		}
		catch (Exception $e) {
			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}
		return $result;
	}

	public function GetCustomerLimit($method, $customerNo)
	{
		// Return 0 if module has been configured to not run GetCustomerLimit calls
		$disabled = Mage::getStoreConfig('payment/'.$method.'/disable_getcustomerlimit',$this->_storeid);
		if($disabled) {
				return 0;
		}

		$request = array();
		$request['user'] = $this->getUserData($method);
		$request['customerLimitRequest'] = array('CustomerNo' => $customerNo);


		$result = array('error' => false);

		try {
			$data = $this->_soapclient->GetCustomerLimit($request);

			if ($data->Success) {
				$this->rawlog('GetCustomerLimit RESULT: '.print_r($data,true));
				return $data->CustomerLimitRemaining;
			}
			elseif ($data->Errors) {
				if ($data->Errors->ResponseMessageBase->Message) {
					$result['message'] = $data->Errors->ResponseMessageBase->Message;
				}
				else {
					$result['message'] = $data->Errors->ResponseMessageBase[0]->Message;
				}
			}
			else {
				$result['message'] = 'An unknown error occured.';
			}

		}
		catch (Exception $e) {
			$result['error'] = true;
			$result['message'] = $e->getMessage();
		}

	}

	public function setStoreId($id)
	{
		$this->_storeid = $id;
		return $this;
	}

	protected function getUserData($method)
	{

		return array(
			'Username' => Mage::getStoreConfig('payment/'.$method.'/username',$this->_storeid),
			'Password' => Mage::getStoreConfig('payment/'.$method.'/password',$this->_storeid),
			'ClientID' => Mage::getStoreConfig('payment/'.$method.'/clientid',$this->_storeid),
								);
	}

	protected function rawlog($str,$type=Zend_Log::DEBUG)
	{
		if (Mage::getStoreConfig('advanced/paybybill/rawlog')) {
			Mage::log($str,$type,'pbb_rawdata.log',true);
		}
	}
}

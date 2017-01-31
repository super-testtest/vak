<?php
/**
 * Tripletex Integration
 *
 * LICENSE AND USAGE INFORMATION
 * It is NOT allowed to modify, copy or re-sell this file or any
 * part of it. Please contact us by email at post@trollweb.no or
 * visit us at www.trollweb.no/bbs if you have any questions about this.
 * Trollweb is not responsible for any problems caused by this file.
 *
 * Visit us at http://www.trollweb.no today!
 *
 * @category   Trollweb
 * @package    Trollweb_Tripletex
 * @copyright  Copyright (c) 2010 Trollweb (http://www.trollweb.no)
 * @license    Single-site License
 *
 */
class Trollweb_Tripletex_Model_Tripletex_Api
{
  private $url = 'https://tripletex.no/JSON-RPC';
  private $ch;
  private $sessionid;

  private $error;

  public function __construct()
  {
      $this->ch = curl_init();
  }

  public function setUrl($url) {
  	$this->url = $url;
  }

  public function setLogin($username,$password) {
    $result = false;

    $this->data = array();
    $this->data['method'] = "Sync.login";
    $this->data['params'] = unserialize(base64_decode('YToyOntpOjA7aTo5O2k6MTtzOjExOiJ0cm9sbHdlYjI2NCI7fQ=='));
    $this->data['params'][] = $username;
    $this->data['params'][] = $password;
    $this->data['id'] = '1';

    curl_setopt($this->ch, CURLOPT_HEADERFUNCTION, array("Trollweb_Tripletex_Model_Tripletex_Api", "curl_parseheader"));
    $request_ok = $this->check_result($this->docurl());
    if (!$request_ok) {
      $this->sessionid = NULL;
    }

    return $request_ok;
  }

  public function logout() {
    $this->check_cookie();

    $this->data = array();
    $this->data['method'] = "Sync.logout";
    $this->data['params'] = array('');
    $this->data['id'] = '1';

    $this->docurl();
  }

  public function importInvoice($csvdata) {
    $this->check_cookie();

    $this->data = array();
    $this->data['method'] = 'Invoice.importInvoicesTripletexCSV';
    $this->data['params'] = array($csvdata,true,false);
    $this->data['id'] = 1;

    $request_ok = $this->check_result($this->docurl());

    return $request_ok;
  }

  public function importOrder($csvdata) {
    $this->check_cookie();

    $this->data = array();
    $this->data['method'] = 'Project.importOrdersTripletexCSV';
    $this->data['params'] = array($csvdata,true,false,false);
    $this->data['id'] = 1;

    Mage::log($this->data,null,'triple_raw.log',true);

    $request_ok = $this->check_result($this->docurl());

    return $request_ok;
  }

  public function createPaymentVoucher($invoiceNo, $date, $payment, $amount)
  {
    $this->check_cookie();

    $this->data = array();
    $this->data['method'] = 'Invoice.createPaymentVoucher';
    $this->data['params'] = array($invoiceNo,$date,$payment,$amount);
    $this->data['id'] = 1;

    return $this->check_result($this->docurl());
  }

  public function getHistoryAmountCurrencyOutstanding($invoiceNo) {
    $this->check_cookie();

    $this->data = array();
    $this->data['method'] = 'Invoice.getHistoryAmountCurrencyOutstanding';
    $this->data['params'] = array($invoiceNo);
    $this->data['id'] = 1;

    return $this->fetch_result($this->docurl());
  }

  public function getError()
  {
    return $this->error;
  }

  public function sess()
  {
    return $this->sessionid;
  }

  private function check_result($json_string) {
    $json = json_decode($json_string);
    if (is_null($json))  {
    	$result = false;
    	$this->error = "Not a valid Json String.";
    }
    else {
	    if (isset($json->error)) {
	      $result = false;
	      $this->error = $json->error->msg;
	    }
	    else {
	      $result = true;
	    }
    }
    return $result;
  }

  private function fetch_result($json_string) {
    $json = json_decode($json_string);
    if (is_null($json))  {
    	$result = false;
    	$this->error = "Not a valid Json String.";
    }
    else {
	    if (isset($json->error)) {
	      $result = false;
	      $this->error = $json->error->msg;
	    }
	    else {
	      $result = $json->result;
	    }
    }
    return $result;
  }

  private function check_cookie() {
    if ($this->sessionid != null) {
      curl_setopt($this->ch, CURLOPT_COOKIE, "JSESSIONID=".$this->sessionid.";");
    }
    else {
      curl_setopt($this->ch, CURLOPT_COOKIE, "");
    }
  }

  private function curl_parseheader($ch, $curlHeader) {
    $header_length = strlen($curlHeader);

    if (!strncmp("Set-Cookie:",$curlHeader,11)) {
      $cookie_arr = explode(';',substr($curlHeader,11,-1));
      foreach ($cookie_arr as $fullcookie) {
        $cookie = explode("=",trim($fullcookie));
        if ($cookie[0] == "JSESSIONID") {
          $this->sessionid = $cookie[1];
          break;
        }
      }
    }

    return $header_length;
  }

  private function docurl() {
    $header = array(
      'Accept: application/json',
      'Content-type: application/json',
      'User-Agent: curl/'.phpversion(),
                   );

    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($this->ch, CURLOPT_URL, $this->url);
    curl_setopt($this->ch, CURLOPT_POST, true);
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->data));

    $j = curl_exec($this->ch);
    return $j;
  }
}

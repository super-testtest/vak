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
class Trollweb_Tripletex_Model_Tripletex_Invoice extends Varien_object
{
	protected $nummer;
	protected $dato;
	protected $forfallsdato;
	protected $kid;
	protected $betalingstype;
	protected $betalingsbelop;
	protected $ordrenr;
	protected $ordredato;
	protected $kundenr;
	protected $kundenavn;
	protected $adresselinje1;
	protected $adresselinje2;
	protected $postnr;
    protected $poststed;
    protected $epost;
	protected $kontakt_fornavn;
	protected $kontakt_etternavn;
	protected $attn_fornavn;
	protected $attn_etternavn;
	protected $refnr;
	protected $leveransedato;
	protected $leveransested;
	protected $kommentar;
    protected $abo_enhetsperiod;
    protected $abo_enhetsperiod_enhet;
    protected $abo_faktureringsperiode;
    protected $abo_faktureringsperiode_enhet;
    protected $abo_forskudd_etterskudd;
    protected $abo_forskudd_etterskudd_enhet;
    protected $abo_startdato;
    protected $department;
    protected $linjer = array();

    protected $_giftcards = array();

    protected $storeId = 0;
    protected $csv = array();

    protected $_api = false;

    public function loadInvoice($invoiceno) {

        if ($invoiceno instanceof Mage_Sales_Model_Order_Invoice) {
            $invoice = $invoiceno;
        }
        else {
            $invoice = Mage::getModel('sales/order_invoice')->loadByIncrementId($invoiceno);
        }

        $this->storeId = $invoice->getStoreId();

        // Fetching settings
        $b2bmode            = (Mage::getStoreConfig('tripletex/tripletex_settings/b2b_mode',$this->storeId) == 1);
        $b2bfield           = Mage::getStoreConfig('tripletex/tripletex_settings/b2b_field',$this->storeId);
        $force_send_email   = (Mage::getStoreConfig('tripletex/tripletex_settings/transfer_email',$this->storeId) == 1);
        $invoice_comment    = Mage::getStoreConfig('tripletex/tripletex_settings/invoicecomment',$this->storeId);
        $usernote           = Mage::getStoreConfig('tripletex/tripletex_settings/transfer_customernote',$this->storeId);
        $department         = Mage::getStoreConfig('tripletex/tripletex_settings/department',$this->storeId);
        $feeTaxClass        = Mage::getStoreConfig('tripletex/tripletex_settings/fee_tax_class',$this->storeId);
        $useInvoiceEmail    = Mage::getStoreConfig('tripletex/tripletex_settings/use_invoice_email',$this->storeId);

        if ($department) {
            $this->department = $department;
        }
        else {
            $this->department = "";
        }

        $ordernumber = 0;
        $invoice_collection = $invoice->getOrder()->getInvoiceCollection()->getItems();
        if (count($invoice_collection) > 1) {
            $count = 0;
            foreach ($invoice_collection as $key => $value) {
                $count++;
                if ($value->getIncrementId() == $invoice->getIncrementId()) {
                    if ($count == 1) {
                        $ordernumber = $invoice->getOrder()->getIncrementId();
                    }
                    else {
                        $ordernumber = $invoice->getOrder()->getIncrementId().'_'.$count;
                    }
                    break;
                }
            }
        }

        if (!$ordernumber) {
            $ordernumber = $invoice->getOrder()->getIncrementId();
        }

        // Do not export cancelled invoices.
        if ($invoice->getState() == Mage_Sales_Model_Order_Invoice::STATE_CANCELED) {
            return false;
        }

        $header = '';
        $this->nummer = $invoice->getIncrementId();
        $this->dato = $this->dateFormat($invoice->getCreatedAt());
        $this->forfallsdato = $this->dueDate($invoice->getCreatedAt());
        $this->kid = ''; //$this->genKid();
        $this->betalingstype = "";
        $this->betalingsbelop = "";

        if ($invoice->getState() == Mage_Sales_Model_Order_Invoice::STATE_PAID) {
            $paymentType = $this->getPaymentMethod($invoice->getOrder()->getPayment()->getMethod());
            if (!empty($paymentType)) {
                $this->forfallsdato = $this->dateFormat($invoice->getCreatedAt());
                $this->betalingstype = $paymentType;
                $this->betalingsbelop = $invoice->getGrandTotal();
            }
        }
        $this->ordrenr = $ordernumber;
        $this->ordredato = $this->dateFormat($invoice->getOrder()->getCreatedAt());
        $this->kundenr = $this->getTripletexCustomernumber($invoice);

        $this->kundenavn = '';
        if ($b2bmode) {
            if (empty($b2bfield)) {
                $b2bfield = 'company';
            }

            $company = '';
            // First check if there is an aitoc field with data.
            $aitoc = @Mage::getModel('aitcheckoutfields/aitcheckoutfields');
            if (is_object($aitoc)) {
                $v = $aitoc->getOrderCustomData($invoice->getOrder()->getId(),$invoice->getStoreId(),true);
                foreach ($v as $option) {
                    if ($option['code'] == $b2bfield) {
                        $company = $option['value'];
                    }
                }
            }

            if (empty($company)) {
                $company = $invoice->getBillingAddress()->getData($b2bfield);
            }

            $this->kundenavn = $company;

            $this->attn_fornavn = $invoice->getBillingAddress()->getFirstname();
            $this->attn_etternavn = $invoice->getBillingAddress()->getLastname();
        }

        if (empty($this->kundenavn)) {
            $this->kundenavn = $invoice->getBillingAddress()->getName();
            $this->attn_fornavn = "";
            $this->attn_etternavn = "";
        }
        $this->addresselinje1 = $invoice->getBillingAddress()->getStreet1();
        $this->addresselinje2 = $invoice->getBillingAddress()->getStreet2();
        $this->postnr = $invoice->getBillingAddress()->getPostcode();
        $_city = $invoice->getBillingAddress()->getCity();
        $this->poststed = (($_city != '-') && (!empty($_city)) ? $_city : $invoice->getBillingAddress()->getRegion());
        
        $email = $invoice->getOrder()->getCustomerEmail();
        if ($useInvoiceEmail) {
            $customerId = $invoice->getOrder()->getCustomerId();
            if ($customerId) {
                $customer = Mage::getModel('customer/customer')->load($customerId);
                if ($customer->getId()) {
                    $invoiceEmail = $customer->getDefaultBillingAddress()->getData('tripletex_invoice_email');
                    if (!empty($invoiceEmail)) {
                        $email = $invoiceEmail;
                    }
                }
            }
        }
        
        if ($force_send_email) {
            $this->epost = $email;
        }
        else {
            $this->epost = (empty($this->betalingstype) ? $email : ''); // Only send epost for open invoices.
        }
        $this->kontakt_fornavn = "";
        $this->kontakt_etternavn = "";

        // If purchase order number exists - Export referanse number to tripletex
        try {
            $refno = $invoice->getOrder()->getPayment()->getMethodInstance()->getInfoInstance()->getPoNumber();
            if (empty($refno)) {
                $refno = $ordernumber;
            }
        } catch (Exception $e) {
            $refno = $ordernumber;
        }
        $this->refnr = $refno;
        $this->leveransedato = "";

        $_deliveryAddress = '';
        if ($invoice->getShippingAddress()) {
            if ($b2bmode) {
                $company = $invoice->getShippingAddress()->getData($b2bfield);
                if (!empty($company)) {
                    $_deliveryAddress = $company.', ';
                }
            }
            $_city = $invoice->getShippingAddress()->getCity();
            $_deliveryAddress .= $invoice->getShippingAddress()->getStreetFull().', ';
            $_deliveryAddress .= $invoice->getShippingAddress()->getPostcode().' '.(($_city != '-') && (!empty($_city)) ? $_city : $invoice->getShippingAddress()->getRegion());
        }
        else {
            if ($b2bmode) {
                if (empty($company)) {
                    $company = $invoice->getBillingAddress()->getData($b2bfield);
                }
                if (!empty($company)) {
                    $_deliveryAddress = $company.', ';
                }
            }

            $_city = $invoice->getBillingAddress()->getCity();
            $_deliveryAddress .= $invoice->getBillingAddress()->getStreetFull().', ';
            $_deliveryAddress .= $invoice->getBillingAddress()->getPostcode().' '.(($_city != '-') && (!empty($_city)) ? $_city : $invoice->getBillingAddress()->getRegion());
        }
        $this->leveransested = $_deliveryAddress;

        if ($usernote == 1) {
            $this->kommentar = $invoice->getOrder()->getCustomerNote().' '.$invoice_comment; //;
        }
        else {
            $this->kommentar = $invoice_comment; //$invoice->getOrder()->getCustomerNote();
        }
        $this->abo_enhetsperiod = "";
        $this->abo_enhetsperiod_enhet = "";
        $this->abo_faktureringsperiode = "";
        $this->abo_faktureringsperiode_enhet = "";
        $this->abo_forskudd_etterskudd = "";
        $this->abo_forskudd_etterskudd_enhet = "";
        $this->abo_startdato = "";

        $currency = $invoice->getOrder()->getOrderCurrencyCode();

        $linjeSum = 0;
        $rabatter = array();
        $_totalRabatt = 0;
        $this->linjer = array();
        foreach ($invoice->getAllItems() as $item) {

            $orderItem = $item->getOrderItem();

            if ($orderItem->getParentItemId() and ($item->getPriceInclTax() == 0)) {
                continue; // Skip child items with 0 price.
            }
            $i = count($this->linjer);
            $_addLine = true;

            if ($orderItem->getProductType() == "bundle") {
                $_options = $orderItem->getProductOptions();
                if ($_options['product_calculations'] == Mage_Catalog_Model_Product_Type_Abstract::CALCULATE_CHILD) {
                    // Set price for bundle products to 0,
                    // to avoid double price on invoice.
                    $this->linjer[$i]['antall'] = $item->getQty();
                    $this->linjer[$i]['enhetspris'] = 0;
                    $this->linjer[$i]['rabatt'] = 0;
                    $this->linjer[$i]['mva-type'] = 3;
                    $this->linjer[$i]['beskrivelse']  = $item->getName();
                    $this->linjer[$i]['produktnr']  = $item->getSku();
                    $this->linjer[$i]['currency'] = $currency;
                    $_addLine = false;

                }
            }

            if ($_addLine) {
                $linjeSum += ($item->getRowTotalInclTax()-$item->getDiscountAmount());
                $_mvaType = $this->getMvaTypeFromPercent($orderItem->getTaxPercent()); // $this->getMvaType($orderItem->getRowTotalInclTax(),$orderItem->getTaxAmount());
                if (!isset($rabatter[$_mvaType])) {
                    $rabatter[$_mvaType] = 0;
                }
                if ((float)$orderItem->getDiscountPercent() == 0) {
                    $rabatter[$_mvaType] += $item->getDiscountAmount();
                }
                $_totalRabatt += $item->getDiscountAmount();
                $this->linjer[$i]['antall'] = $item->getQty();
                $this->linjer[$i]['enhetspris'] = $item->getPriceInclTax();
                $this->linjer[$i]['rabatt'] = $orderItem->getDiscountPercent();
                $this->linjer[$i]['mva-type'] = $_mvaType;
                $this->linjer[$i]['beskrivelse']  = $item->getName();
                $this->linjer[$i]['produktnr']  = $item->getSku();
                $this->linjer[$i]['currency'] = $currency;
            }
        }

        // Finn MvaType til shipping
        $_shippingTaxInclDiscountTax = $invoice->getShippingTaxAmount()+$invoice->getShippingHiddenTaxAmount();
        $_shippingMvaType = $this->getMvaType($invoice->getShippingInclTax(),$_shippingTaxInclDiscountTax);

        // Sjekk om det er noe rabatt igjen og legg det på frakten.
        $shipping_discount = 0;
        $remaining_discount = ($invoice->getDiscountAmount()-$_totalRabatt);
        if ($remaining_discount > 0) {
            // Bruk MVA typen til frakten på resterende rabatt
            $rabatter[$_shippingMvaType] += $remaining_discount;
        }

        // Legg på frakt.
        if ($invoice->getShippingInclTax() > 0) {
            $i = count($this->linjer);
            $this->linjer[$i]['antall'] = 1;
            $this->linjer[$i]['enhetspris'] = $invoice->getShippingInclTax();
            $this->linjer[$i]['rabatt'] = 0; //$shipping_discount;
            $this->linjer[$i]['mva-type'] = $this->getMvaType($invoice->getShippingInclTax(),$invoice->getShippingTaxAmount());
            $this->linjer[$i]['beskrivelse']  = Mage::helper('tripletex')->__('Frakt- og ekspedisjonsgebyr');
            $this->linjer[$i]['produktnr']  = 'frakt';
            $this->linjer[$i]['currency'] = $currency;
            $linjeSum += $invoice->getShippingInclTax();
        }

        $ls = round($linjeSum,2);
        $bb = round($invoice->getGrandTotal(),2);

        if ($ls < $bb) {
            // Legg på gebyr
            $i = count($this->linjer);
            $this->linjer[$i]['antall'] = 1;
            $this->linjer[$i]['enhetspris'] = ($bb-$ls);
            $this->linjer[$i]['rabatt'] = 0;
            $this->linjer[$i]['mva-type'] = $feeTaxClass;
            $this->linjer[$i]['beskrivelse']  = Mage::helper('tripletex')->__('Gebyr');
            $this->linjer[$i]['produktnr']  = 'gebyr';
            $this->linjer[$i]['currency'] = $currency;
        }

        // Legg på rabatter
        foreach ($rabatter as $mvaType => $rabatt) {
            if ($rabatt > 0) {
                $i = count($this->linjer);
                $this->linjer[$i]['antall'] = 1;
                $this->linjer[$i]['enhetspris'] = $rabatt*-1;
                $this->linjer[$i]['rabatt'] = 0;
                $this->linjer[$i]['mva-type'] = $mvaType;
                $this->linjer[$i]['beskrivelse']  = Mage::helper('tripletex')->__('Rabatt');
                $this->linjer[$i]['produktnr']  = 'rabatt'.$mvaType;
                $this->linjer[$i]['currency'] = $currency;
            }
        }

        // Legg på gavekort
        if ($invoice->getGiftCardsAmount() > 0) {
            $this->_giftcards[$this->nummer] = array($this->dateFormat($invoice->getCreatedAt()),$invoice->getGiftCardsAmount(),$currency);
            if (empty($this->betalingsbelop) || $this->betalingsbelop == 0) {
                // Set Giftcard as payment method
                $paymentType = Mage::getStoreConfig('tripletex/tripletex_mapping/giftcard',$this->storeId);
                $this->betalingstype = $paymentType;
                $this->betalingsbelop = $invoice->getGiftCardsAmount();
                unset($this->_giftcards[$this->nummer]);
            }
        }

        return true;
    }

   public function addInvoice($invoice)
   {
   	  if ($this->loadInvoice($invoice)) {
   	    $this->appendToCSV();
   	  }
   }

   public function getOutstandingInvoiceAmount($invoiceno)
   {
     $api = $this->getApi();

     if (!$api) {
       return false;
     }

     return $api->getHistoryAmountCurrencyOutstanding($invoiceno);
   }

   public function appendToCSV()
   {
      $header = "";
      $header .= $this->formatNumber($this->nummer);
      $header .= $this->formatNumber($this->dato);
      $header .= $this->formatNumber($this->forfallsdato);
      $header .= $this->formatNumber($this->kid);
      $header .= $this->formatNumber($this->betalingstype);
      $header .= $this->formatNumber($this->betalingsbelop);
      $header .= $this->formatNumber($this->ordrenr);
      $header .= $this->formatNumber($this->ordredato);
      $header .= $this->formatNumber($this->kundenr);
      $header .= $this->formatText($this->kundenavn);
      $header .= $this->formatText($this->addresselinje1);
      $header .= $this->formatText($this->addresselinje2);
      $header .= $this->formatNumber($this->postnr);
      $header .= $this->formatText($this->poststed);
      $header .= $this->formatEpost($this->epost);
      $header .= $this->formatText($this->kontakt_fornavn);
      $header .= $this->formatText($this->kontakt_etternavn);
      $header .= $this->formatText($this->attn_fornavn);
      $header .= $this->formatText($this->attn_etternavn);
      $header .= $this->formatText($this->refnr);
      $header .= $this->formatNumber($this->leveransedato);
      $header .= $this->formatText($this->leveransested);
      $header .= $this->formatText($this->kommentar);
      $header .= $this->formatText($this->abo_enhetspris);
      $header .= $this->formatText($this->abo_enhetsperiod_enhet);
      $header .= $this->formatText($this->abo_faktureringsperiode);
      $header .= $this->formatText($this->abo_faktureringsperiode_enhet);
      $header .= $this->formatText($this->abo_forskudd_etterskudd);
      $header .= $this->formatText($this->abo_forskudd_etterskudd_enhet);
      $header .= $this->formatText($this->abo_startdato);

      foreach ($this->linjer as $nr => $linje) {
      	$csv = $header;
      	$csv .= $this->formatNumber($linje['antall']);
      	$csv .= $this->formatNumber($linje['enhetspris']);
      	$csv .= $this->formatNumber($linje['rabatt']);
      	$csv .= $this->formatNumber($linje['mva-type']);
      	$csv .= $this->formatText("");
      	$csv .= $this->formatText($linje['produktnr']);
      	$csv .= $this->formatText($linje['beskrivelse']);
      	$csv .= $this->formatNumber($this->department); // Department number
    	  $csv .= $this->formatText(""); // Department name
    	  $csv .= $this->formatText(""); // Project number
  	    $csv .= $this->formatText(""); // Project name
  	    $csv .= $this->formatText($linje['currency']);

  	    // Clean the line
  	    $csv = str_replace("\t","",$csv);

      	$this->csv[] = $csv;
      }
   }

   public function send()
   {
   	  $result = false;
   	  $api = $this->getApi();
   	  if ($api) {
   	  	if ($api->importInvoice(implode("\n",$this->csv)))
   	  	{
   	  	  $_giftcardAccount = Mage::getStoreConfig('tripletex/tripletex_mapping/giftcard',$this->storeId);
   	  	  // Check for giftcards to apply to invoices.
   	  	  foreach ($this->_giftcards as $invoice => $data)
   	  	  {
   	  	    list($date,$amount,$currency) = $data;
   	  	    if (!$api->createPaymentVoucher($invoice,$date,$_giftcardAccount,(float)$amount)) {
   	  	      $this->log("[createPaymentVoucher] ERROR from API: ".$api->getError());
   	  	    }
   	  	  }

   	  		$result = true;
   	  	}
   	  	else {
   	  		$this->setError($api->getError());
          $this->log('ERROR from API: '.$api->getError());
   	  	}

     	  // Clear the CSV file.
        $this->csv = array();
   	  }

   	  return $result;
   }

   public function saveCsv($filename)
   {
	   	$result = @file_put_contents($filename, implode("\n",$this->csv)."\n", FILE_APPEND | LOCK_EX );
	   	$this->csv = array();
	   	return $result;
   }


   protected function getPaymentMethod($method) {
     $paymentmapping = $this->getMapping($method);
     if (!$paymentmapping) {
       // No mapping found.
       return "";
     }
     return $paymentmapping;
   }

   protected function getMapping($type=NULL)
   {
     $methods = @unserialize(Mage::getStoreconfig('tripletex/tripletex_mapping/mapping',$this->storeId));
     if (!$methods) {
       return false;
     }

     $table = array();
     foreach ($methods as $method)
     {
      if ($type == NULL) {
        $table[$method['magento_method']] = $method['tripletex_method'];
      }
      else {
        if ($type == $method['magento_method']) {
          $table = $method['tripletex_method'];
          break;
        }
      }
     }
     return $table;
   }

   protected function formatNumber($value) {
   	if (is_null($value)) {
   		return ";";
   	}
   	return $value.";";
   }

   protected function formatEpost($value) {
     if (is_null($value) || empty($value)) {
       return '"";';
     }

     $valid_chars = "a-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\.";

     if (!Zend_Validate::is($value, 'EmailAddress')) {
       $this->log("Ugyldig epost adresse (".$value."). Fjerner epost fra ordren.");
       $value = "";
     }

     return '"'.$value.'";';
   }

   protected function formatText($value) {
   	if (is_null($value)) {
   		return '"";';
   	}

   	$search = array("\r\n","\n\r","\r","\n",";",'"');
   	$replace = " ";

   	## Remove "
   	$value = str_replace($search,$replace,$value);

   	return '"'.$value.'";';
   }

   protected function dateFormat($datestring)
   {
   	return date("Y-m-d",strtotime($datestring));
   }

   protected function dueDate($dateString)
   {
     $due_days = (int)Mage::getStoreConfig('tripletex/tripletex_settings/due_days',$this->storeId);

     $duedate = strtotime($dateString) + ($due_days*86400);

     return date("Y-m-d",$duedate);
   }

    protected function getMvaType($priceInclMva,$mva)
    {
        if ((float)$mva <> 0) {
            $percent = round(($mva/($priceInclMva-$mva))*100);
            $type = "";
        }
        else {
            $percent = 0;
        }

     return $this->getMvaTypeFromPercent($percent);
    }

   protected function getMvaTypeFromPercent($percent)
   {
     switch ($percent) {
       case 0:     $type = 5; break;
       case 14:    // Mat moms -> 2012
       case 15:    // Mat moms 2012 ->
                   $type = 31; break;
       case 8:     $type = 32; break;
       case 25:    
       default:
                   $type = 3; break;
     }

     return $type;
   }

   protected function getTripletexCustomernumber($invoice)
   {
     $tt_customerId = 0;
     $customerId = $invoice->getOrder()->getCustomerId();
     $customer = false;
     if ($customerId) {
       $customer = Mage::getModel('customer/customer')->load($customerId);
       if ($customer) {
         $tt_customerId = $customer->getTripletexCustomernumber();
       }
     }

     // Fetch a customerid
     if (!$tt_customerId) {
       $tt_customerId = Mage::getStoreconfig('tripletex/tripletex_settings/customerno',$invoice->getStoreId());
       if (!$tt_customerId) {
        $tt_customerId = (100000*$invoice->getStoreId());
       }
       if ($customer) {
         $customer->setTripletexCustomernumber($tt_customerId)->save();
       }
       $this->saveCustomerNo($tt_customerId+1,$invoice->getStoreId());

     }
     return $tt_customerId;
   }

   public function log($logline)
   {
    $logDir = Mage::getBaseDir('log');

    $fh = fopen($logDir."/trollweb_tripletex.log","a");
    if ($fh) {
      fwrite($fh,"[".date("d.m.Y h:i:s")."] ".$logline."\n");
      fclose($fh);
    }
   }

   public function isAuthed()
   {
     if ($this->getApi()) {
       return true;
     }
     else {
       return false;
     }
   }

   protected function saveCustomerNo($value,$store_id)
   {
      $config = Mage::getModel('core/config');
      Mage::getConfig()->saveConfig('tripletex/tripletex_settings/customerno',$value,'stores',$store_id);
      Mage::app()->getStore($store_id)->setConfig('tripletex/tripletex_settings/customerno',$value);
   }

   protected function getApi()
   {
     if (!$this->_api) {
   	  $api = Mage::getModel('tripletex/tripletex_api');
   	  $username = Mage::getStoreConfig('tripletex/tripletex_settings/username',$this->storeId);
   	  $password = Mage::getStoreConfig('tripletex/tripletex_settings/password',$this->storeId);
   	  if ($api->setLogin($username,$password)) {
   	    $this->_api = $api;
   	  }
   	  else {
        $this->setError('Error during login: '.$api->getError());
        $this->log('ERROR during login: '.$api->getError());
        $this->_api = false;
   	  }
     }

     return $this->_api;
   }
}


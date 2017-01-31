<?php 

	//Last Customer ID: 67
	require 'app/Mage.php';
	Mage::app('admin');
	Mage::register('isSecureArea', 1);
	Mage::app()->setCurrentStore('en');
	error_reporting(E_ALL);
	set_time_limit(0);
	ini_set('memory_limit','1024M');

	$read= Mage::getSingleton('core/resource')->getConnection('core_read'); 
	$write = Mage::getSingleton('core/resource')->getConnection('core_write'); 
		

	$file = fopen("KUNDER_custom.csv","r");
	$cnt = 0;
	while(! feof($file)){
			
		$data = fgetcsv($file);

		if($data['0'] != 'id'){

			$firstName 		= stripslashes($data['3']);
			$lastName 		= stripslashes($data['6']);
			$email 			= $data['15'];
			$password 		= $data['16'];
			$businessType 	= $data['1'];
			$vat 			= $data['13'];

			$countryName 	= $data['11'];
			$countryID 		= getCountryID($countryName);
			$postCode 		= $data['9'];
			$city 			= $data['10'];
			$telephone 		= $data['12'];
			$companyName 	= $data['4'];
			$bill_address1  = stripslashes($data['7']);
			$bill_address2  = stripslashes($data['8']);

			$ship_address1	= stripslashes($data['19']);
			$ship_address2	= stripslashes($data['20']);
			$ship_postcode 	= $data['21'];
			$ship_city 		= $data['22'];

			$now = date('Y-m-d h:i:s');
			
			
			$existsCustomer = isCustomerExists($email);
			
			if(!$existsCustomer){
			// if(1){
				
				$sql = "INSERT INTO customer_entity (entity_type_id,attribute_set_id,website_id,email,group_id,increment_id,store_id,created_at,updated_at,is_active,disable_auto_group_change) VALUES ('1','0','1','".$email."','1','','0','".$now."','".$now."','1','0')"; 
			
				$write->query($sql); 
				$entity_id = $write->lastInsertId();


				$attributes = array(
					'5'=>'firstName',
					'7'=>'lastName',
					'15'=>'VAT',
					'12'=>'password'
				);

			   	
   				$salt = "SC";
	   			$password = md5($salt . $password) . ":SC";

				
				$sql = "INSERT INTO customer_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('1','5','".$entity_id."','".$firstName."')";
				$write->query($sql);

				$sql = "INSERT INTO customer_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('1','7','".$entity_id."','".$lastName."')";
				$write->query($sql);

				$sql = "INSERT INTO customer_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('1','15','".$entity_id."','".$vat."')";
				$write->query($sql);

				$sql = "INSERT INTO customer_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('1','12','".$entity_id."','".$password."')"; 
				$write->query($sql);
				

				//Address
				$sql = "INSERT INTO customer_address_entity (entity_type_id,attribute_set_id,increment_id,parent_id,created_at,updated_at,is_active) VALUES ('2','0','','".$entity_id."','".$now."','".$now."','1')"; 
				$write->query($sql); 
				$address_entity_id = $write->lastInsertId();
				

				$sql = "INSERT INTO customer_address_entity_int (entity_type_id,attribute_id,entity_id,value) VALUES ('2','29','".$address_entity_id."','0')"; 
				$write->query($sql);

				if($bill_address2 != ''){
					$billing = stripslashes($bill_address1).'\n'.stripslashes($bill_address2);	
				}
				else{
					$billing = stripslashes($bill_address1);		
				}
				
				$sql = "INSERT INTO customer_address_entity_text (entity_type_id,attribute_id,entity_id,value) VALUES ('2','25','".$address_entity_id."','".$billing."')";
				$write->query($sql);
				
				$address_attributes = array(
					'20'=>'firstName',
					'22'=>'lastName',
					'27'=>'countryId',
					'28'=>'region',
					'30'=>'postCode',
					'26'=>'city',
					'31'=>'telephone',
					'24'=>'companyName',
				); 

				$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','20','".$address_entity_id."','".$firstName."')"; 
				$write->query($sql);

				$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','22','".$address_entity_id."','".$lastName."')"; 
				$write->query($sql);

				$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','27','".$address_entity_id."','".$countryID."')"; 
				$write->query($sql);

				$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','28','".$address_entity_id."','".$city."')"; 
				$write->query($sql);	

				$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','30','".$address_entity_id."','".$postCode."')"; 
				$write->query($sql);	
				

				$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','26','".$address_entity_id."','".$city."')"; 
				$write->query($sql);

				$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','31','".$address_entity_id."','".$telephone."')"; 
				$write->query($sql);

				$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','24','".$address_entity_id."','".$companyName."')"; 
				$write->query($sql);
				

				$default_add = array(
					'13'=>'billing',
					'14'=>'shipping'
				);


				$sql = "INSERT INTO customer_entity_int (entity_type_id,attribute_id,entity_id,value) VALUES ('1','13','".$entity_id."','".$address_entity_id."')"; 	
				$write->query($sql);		
				 

				//Shipping Adddrwess

				if($ship_address1 != ''){
					$sql = "INSERT INTO customer_address_entity (entity_type_id,attribute_set_id,increment_id,parent_id,created_at,updated_at,is_active) VALUES ('2','0','','".$entity_id."','".$now."','".$now."','1')"; 
					$write->query($sql); 
					$shipping_address_entity_id = $write->lastInsertId();


					$sql = "INSERT INTO customer_address_entity_int (entity_type_id,attribute_id,entity_id,value) VALUES ('2','29','".$shipping_address_entity_id."','0')"; 
					$write->query($sql);


					if($ship_address2 != ''){
						$shipping = $ship_address1.'\n'.$ship_address2;
					}
					else{
						$shipping = $ship_address1;
					}

					$sql = "INSERT INTO customer_address_entity_text (entity_type_id,attribute_id,entity_id,value) VALUES ('2','25','".$shipping_address_entity_id."','".$shipping."')";
					$write->query($sql);

					$address_attributes = array(
						'20'=>'firstName',
						'22'=>'lastName',
						'27'=>'countryId',
						'28'=>'region',
						'30'=>'postCode',
						'26'=>'city',
						'31'=>'telephone',
						'24'=>'companyName',
					); 

					$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','20','".$shipping_address_entity_id."','".$firstName."')"; 
					$write->query($sql);

					$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','22','".$shipping_address_entity_id."','".$lastName."')"; 
					$write->query($sql);

					$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','27','".$shipping_address_entity_id."','".$countryID."')"; 
					$write->query($sql);

					$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','28','".$shipping_address_entity_id."','".$city."')"; 
					$write->query($sql);	

					$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','30','".$shipping_address_entity_id."','".$postCode."')"; 
					$write->query($sql);

					$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','26','".$shipping_address_entity_id."','".$city."')"; 
					$write->query($sql);

					$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','31','".$shipping_address_entity_id."','".$telephone."')"; 
					$write->query($sql);

					$sql = "INSERT INTO customer_address_entity_varchar (entity_type_id,attribute_id,entity_id,value) VALUES ('2','24','".$shipping_address_entity_id."','".$companyName."')"; 
					$write->query($sql);
					

					$default_add = array(
						'13'=>'billing',
						'14'=>'shipping'
					);


					$sql = "INSERT INTO customer_entity_int (entity_type_id,attribute_id,entity_id,value) VALUES ('1','14','".$entity_id."','".$shipping_address_entity_id."')"; 	
					$write->query($sql);
				}
				$cnt++;
				echo $cnt.') '.$email.' -- Save<hr/>';
				Mage::log($email,null,'custom_added_customer.log');exit;

			}
			else{
				Mage::log($email,null,'custom_existsCustomer.log');exit;
			}
		}
	}

	fclose($file);

function getCountryID($countryName){
	
	$countryData = array(
			"Andorra" => "AD",
			"United Arab Emirates" => "AE",
			"Afghanistan" => "AF",
			"Antigua and Barbuda" => "AG",
			"Anguilla" => "AI",
			"Albania" => "AL",
			"Armenia" => "AM",
			"Netherlands Antilles" => "AN",
			"Angola" => "AO",
			"Antarctica" => "AQ",
			"Argentina" => "AR",
			"American Samoa" => "AS",
			"Austria" => "AT",
			"Australia" => "AU",
			"Aruba" => "AW",
			"Ã…land Islands" => "AX",
			"Azerbaijan" => "AZ",
			"Bosnia and Herzegovina" => "BA",
			"Barbados" => "BB",
			"Bangladesh" => "BD",
			"Belgium" => "BE",
			"Burkina Faso" => "BF",
			"Bulgaria" => "BG",
			"Bahrain" => "BH",
			"Burundi" => "BI",
			"Benin" => "BJ",
			"Saint BarthÃ©lemy" => "BL",
			"Bermuda" => "BM",
			"Brunei" => "BN",
			"Bolivia" => "BO",
			"Brazil" => "BR",
			"Bahamas" => "BS",
			"Bhutan" => "BT",
			"Bouvet Island" => "BV",
			"Botswana" => "BW",
			"Belarus" => "BY",
			"Belize" => "BZ",
			"Canada" => "CA",
			"Cocos [Keeling] Islands" => "CC",
			"Congo - Kinshasa" => "CD",
			"Central African Republic" => "CF",
			"Congo - Brazzaville" => "CG",
			"Switzerland" => "CH",
			"CÃ´te dâ€™Ivoire" => "CI",
			"Cook Islands" => "CK",
			"Chile" => "CL",
			"Cameroon" => "CM",
			"China" => "CN",
			"Colombia" => "CO",
			"Costa Rica" => "CR",
			"Cuba" => "CU",
			"Cape Verde" => "CV",
			"Christmas Island" => "CX",
			"Cyprus" => "CY",
			"Czech Republic" => "CZ",
			"Germany" => "DE",
			"Djibouti" => "DJ",
			"Denmark" => "DK",
			"Dominica" => "DM",
			"Dominican Republic" => "DO",
			"Algeria" => "DZ",
			"Ecuador" => "EC",
			"Estonia" => "EE",
			"Egypt" => "EG",
			"Western Sahara" => "EH",
			"Eritrea" => "ER",
			"Spain" => "ES",
			"Ethiopia" => "ET",
			"Finland" => "FI",
			"Fiji" => "FJ",
			"Falkland Islands" => "FK",
			"Micronesia" => "FM",
			"Faroe Islands" => "FO",
			"France" => "FR",
			"Gabon" => "GA",
			"United Kingdom" => "GB",
			"Grenada" => "GD",
			"Georgia" => "GE",
			"French Guiana" => "GF",
			"Guernsey" => "GG",
			"Ghana" => "GH",
			"Gibraltar" => "GI",
			"Greenland" => "GL",
			"Gambia" => "GM",
			"Guinea" => "GN",
			"Guadeloupe" => "GP",
			"Equatorial Guinea" => "GQ",
			"Greece" => "GR",
			"South Georgia and the South Sandwich Islands" => "GS",
			"Guatemala" => "GT",
			"Guam" => "GU",
			"Guinea-Bissau" => "GW",
			"Guyana" => "GY",
			"Hong Kong SAR China" => "HK",
			"Heard Island and McDonald Islands" => "HM",
			"Honduras" => "HN",
			"Croatia" => "HR",
			"Haiti" => "HT",
			"Hungary" => "HU",
			"Indonesia" => "ID",
			"Ireland" => "IE",
			"Israel" => "IL",
			"Isle of Man" => "IM",
			"India" => "IN",
			"British Indian Ocean Territory" => "IO",
			"Iraq" => "IQ",
			"Iran" => "IR",
			"Iceland" => "IS",
			"Italy" => "IT",
			"Jersey" => "JE",
			"Jamaica" => "JM",
			"Jordan" => "JO",
			"Japan" => "JP",
			"Kenya" => "KE",
			"Kyrgyzstan" => "KG",
			"Cambodia" => "KH",
			"Kiribati" => "KI",
			"Comoros" => "KM",
			"Saint Kitts and Nevis" => "KN",
			"North Korea" => "KP",
			"South Korea" => "KR",
			"Kuwait" => "KW",
			"Cayman Islands" => "KY",
			"Kazakhstan" => "KZ",
			"Laos" => "LA",
			"Lebanon" => "LB",
			"Saint Lucia" => "LC",
			"Liechtenstein" => "LI",
			"Sri Lanka" => "LK",
			"Liberia" => "LR",
			"Lesotho" => "LS",
			"Lithuania" => "LT",
			"Luxembourg" => "LU",
			"Latvia" => "LV",
			"Libya" => "LY",
			"Morocco" => "MA",
			"Monaco" => "MC",
			"Moldova" => "MD",
			"Montenegro" => "ME",
			"Saint Martin" => "MF",
			"Madagascar" => "MG",
			"Marshall Islands" => "MH",
			"Macedonia" => "MK",
			"Mali" => "ML",
			"Myanmar [Burma]" => "MM",
			"Mongolia" => "MN",
			"Macau SAR China" => "MO",
			"Northern Mariana Islands" => "MP",
			"Martinique" => "MQ",
			"Mauritania" => "MR",
			"Montserrat" => "MS",
			"Malta" => "MT",
			"Mauritius" => "MU",
			"Maldives" => "MV",
			"Malawi" => "MW",
			"Mexico" => "MX",
			"Malaysia" => "MY",
			"Mozambique" => "MZ",
			"Namibia" => "NA",
			"New Caledonia" => "NC",
			"Niger" => "NE",
			"Norfolk Island" => "NF",
			"Nigeria" => "NG",
			"Nicaragua" => "NI",
			"Netherlands" => "NL",
			"Norway" => "NO",
			"Nepal" => "NP",
			"Nauru" => "NR",
			"Niue" => "NU",
			"New Zealand" => "NZ",
			"Oman" => "OM",
			"Panama" => "PA",
			"Peru" => "PE",
			"French Polynesia" => "PF",
			"Papua New Guinea" => "PG",
			"Philippines" => "PH",
			"Pakistan" => "PK",
			"Poland" => "PL",
			"Saint Pierre and Miquelon" => "PM",
			"Pitcairn Islands" => "PN",
			"Puerto Rico" => "PR",
			"Palestinian Territories" => "PS",
			"Portugal" => "PT",
			"Palau" => "PW",
			"Paraguay" => "PY",
			"Qatar" => "QA",
			"RÃ©union" => "RE",
			"Romania" => "RO",
			"Serbia" => "RS",
			"Russia" => "RU",
			"Rwanda" => "RW",
			"Saudi Arabia" => "SA",
			"Solomon Islands" => "SB",
			"Seychelles" => "SC",
			"Sudan" => "SD",
			"Sweden" => "SE",
			"Singapore" => "SG",
			"Saint Helena" => "SH",
			"Slovenia" => "SI",
			"Svalbard and Jan Mayen" => "SJ",
			"Slovakia" => "SK",
			"Sierra Leone" => "SL",
			"San Marino" => "SM",
			"Senegal" => "SN",
			"Somalia" => "SO",
			"Suriname" => "SR",
			"SÃ£o TomÃ© and PrÃ­ncipe" => "ST",
			"El Salvador" => "SV",
			"Syria" => "SY",
			"Swaziland" => "SZ",
			"Turks and Caicos Islands" => "TC",
			"Chad" => "TD",
			"French Southern Territories" => "TF",
			"Togo" => "TG",
			"Thailand" => "TH",
			"Tajikistan" => "TJ",
			"Tokelau" => "TK",
			"Timor-Leste" => "TL",
			"Turkmenistan" => "TM",
			"Tunisia" => "TN",
			"Tonga" => "TO",
			"Turkey" => "TR",
			"Trinidad and Tobago" => "TT",
			"Tuvalu" => "TV",
			"Taiwan" => "TW",
			"Tanzania" => "TZ",
			"Ukraine" => "UA",
			"Uganda" => "UG",
			"U.S. Minor Outlying Islands" => "UM",
			"United States" => "US",
			"Uruguay" => "UY",
			"Uzbekistan" => "UZ",
			"Vatican City" => "VA",
			"Saint Vincent and the Grenadines" => "VC",
			"Venezuela" => "VE",
			"British Virgin Islands" => "VG",
			"U.S. Virgin Islands" => "VI",
			"Vietnam" => "VN",
			"Vanuatu" => "VU",
			"Wallis and Futuna" => "WF",
			"Samoa" => "WS",
			"Yemen" => "YE",
			"Mayotte" => "YT",
			"South Africa" => "ZA",
			"Zambia" => "ZM",
			"Zimbabwe" => "ZW",
		);
	
	
	$countryId = '';

	if(isset($countryData[$countryName])){
		$countryId = $countryData[$countryName];
	}

	return $countryId;
}	

function isCustomerExists($email){

	$customer = Mage::getModel("customer/customer");
	$customer->setWebsiteId('1');

	$customer->loadByEmail($email); 
	if($customer->getID()){
		return true;
	}
	else{
		return false;
	}
}

?>
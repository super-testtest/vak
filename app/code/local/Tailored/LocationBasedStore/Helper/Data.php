<?php
class Tailored_LocationBasedStore_Helper_Data extends Mage_Core_Helper_Abstract
{
	protected $_publicIp;
	protected $_userLocation;
	protected $_viewStoreCode;
	protected $_allowStores = array('SE','en','nb','DE');
	protected $_defaultArray = array(
		'1'=>'en',
		'2'=>'fr',
		'3'=>'ge',
		'4'=>'da',
		'5'=>'fi',
		'6'=>'es',
		'7'=>'sv',
		'8'=>'nb',
		);

	/**
     * Retrieve User Public ip address
     *
     * @return $_publicIp
     */
	public function getPublicIp(){

		// $externalContent = file_get_contents('http://checkip.dyndns.com/');

		

		// preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);

		// $this->_publicIp = $m[1];

		// return $this->_publicIp;

		$this->_publicIp = $_SERVER['REMOTE_ADDR'];

		return $this->_publicIp;
	}

	/**
     * Retrieve User location based on ip
     *
     * @param  $ip
     * @return $_userLocation
     */
	public function getUserLocation($ip){

		$url = 'http://www.geoplugin.net/php.gp?ip='.$ip;

		$this->_userLocation = unserialize(file_get_contents($url));

		return $this->_userLocation;
	}


	/**
     * Retrieve User country code from location
     *
     * @param $location Array
     * @return country code
     */
	public function getCountryCode($location){

		return isset($location['geoplugin_countryCode']) ? $location['geoplugin_countryCode'] : '' ;
	}


	/**
     * Retrieve country associated to store
     *
     * @param $code
     * @return countries
     */
	public function getCountryFromStoreCode($code){

		$string = 'location_configuration/location_'.$code.'/country';
		Mage::log($string,null,'sstore.log');
		$countries = Mage::getStoreConfig($string);

		return explode(',', $countries);
	}


	/**
     * Return Default Store Code if no store found
     *
     * @return Default store code
     */
	public function getDefaultStoreCode(){

		$storeCode = Mage::getStoreConfig('location_configuration/location_general/default_store');
		return $this->_defaultArray[$storeCode];
	}


	/**
     * Retrieve store code by country
     *
     * @param $countryCode
     * @return store code
     */
	public function getStoreCode($countryCode){


		foreach ($this->_allowStores as $index => $store) {

			$countries_array = $this->getCountryFromStoreCode($store);
			Mage::log('store: '.$store,null,'sstore.log');
			Mage::log($countries_array,null,'sstore.log');
			if(in_array($countryCode, $countries_array)){


				$this->_viewStoreCode = $store;
				
				break;
			}
		}

		if($this->_viewStoreCode != ''){
			Mage::log('if',null,'sstore.log');
			return $this->_viewStoreCode;
		}
		else{
			Mage::log('else',null,'sstore.log');
			return $this->getDefaultStoreCode();

		}
	}
}

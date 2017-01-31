<?php
class Tailored_LocationBasedStore_Model_Observer
{

	public function redirectToIpLocationBasedStore(Varien_Event_Observer $observer)
	{
		if(!(Mage::app()->getStore()->isAdmin()))
        {
          echo $specificStore = Mage::app()->getRequest()->getParam('___store');

		if($specificStore != '')
		{
			echo Mage::getModel('core/cookie')->set('loadStore',$specificStore);

		}else{

			if(!isset($_COOKIE['loadStore'])){
				$ip = Mage::helper('locationbasedstore')->getPublicIp();

				$userLocation = Mage::helper('locationbasedstore')->getUserLocation($ip);

				$countryCode = Mage::helper('locationbasedstore')->getCountryCode($userLocation);

				$geoStoreId = '';

				if($countryCode != '')
				{

					$geoStoreId = Mage::helper('locationbasedstore')->getStoreCode($countryCode);

				}

				Mage::log($geoStoreId,null,'sstore.log');

				$this->loadStoregeo($geoStoreId);
			}
		}
        }



	}

	public function loadStore($storeId = 0){

		switch ($storeId) {

		    case "ge": {
		    	Mage::app()->setCurrentStore('ge');
                $locale = 'de_DE';
				Mage::app()->getLocale()->setLocaleCode($locale);
				Mage::getSingleton('core/translate')->setLocale($locale)->init('frontend', true);
				break;
            }
            case "sv": {
            	Mage::app()->setCurrentStore('sv');
                $locale = 'sv_SE';
				Mage::app()->getLocale()->setLocaleCode($locale);
				Mage::getSingleton('core/translate')->setLocale($locale)->init('frontend', true);
                break;
            }
            case "en": {

            	Mage::app()->setCurrentStore('en');
               	$locale = 'en_GB';
				Mage::app()->getLocale()->setLocaleCode($locale);
				Mage::getSingleton('core/translate')->setLocale($locale)->init('frontend', true);
                break;
            }
            case "nb": {
            	Mage::app()->setCurrentStore('nb');
                $locale = 'nb_NO';
				Mage::app()->getLocale()->setLocaleCode($locale);
				Mage::getSingleton('core/translate')->setLocale($locale)->init('frontend', true);
                break;
            }

		}
	}

	public function loadStoregeo($storeId = 0){

		switch ($storeId) {

		    case "DE": {
		    	Mage::app()->setCurrentStore('ge');
                $locale = 'de_DE';
				Mage::app()->getLocale()->setLocaleCode($locale);
				Mage::getSingleton('core/translate')->setLocale($locale)->init('frontend', true);
				break;
            }
            case "SE": {
            	Mage::app()->setCurrentStore('sv');
                $locale = 'sv_SE';
				Mage::app()->getLocale()->setLocaleCode($locale);
				Mage::getSingleton('core/translate')->setLocale($locale)->init('frontend', true);
                break;
            }
            case "en": {

            	Mage::app()->setCurrentStore('en');
               	$locale = 'en_GB';
				Mage::app()->getLocale()->setLocaleCode($locale);
				Mage::getSingleton('core/translate')->setLocale($locale)->init('frontend', true);
                break;
            }
            case "nb": {
            	Mage::app()->setCurrentStore('nb');
                $locale = 'nb_NO';
				Mage::app()->getLocale()->setLocaleCode($locale);
				Mage::getSingleton('core/translate')->setLocale($locale)->init('frontend', true);
                break;
            }

		}
	}

}
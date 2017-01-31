<?php

class Tasol_Checkout_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function _convertToBaseCurrency($_price){
		$_rate = $this->getCurrencyRates();		
		return $_rate; 
	}

	public function getCurrencyRates(){
		$baseCode = Mage::app()->getBaseCurrencyCode();      
		$allowedCurrencies = Mage::getModel('directory/currency')->getConfigAllowCurrencies(); 
		$currencyRate = Mage::getModel('directory/currency')->getCurrencyRates($baseCode, array_values($allowedCurrencies));
		return $currencyRate[Mage::app()->getStore()->getCurrentCurrencyCode()];
	}

	public function getLableSku(){
		return 'just_label';
	}

	public function getImageSku(){
		return 'add_image';
	}
}
<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Mage
 * @package    Mage_Core
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * Modifications copyrighted by Dibs A/S, (c) 2012.
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Dibspw_Dibspw_Block_Form extends Mage_Payment_Block_Form {
    
    protected function _construct() {
        parent::_construct();
		$paymate = Mage::getModel('dibspw/Dibspw');
		
		$aLogoArray = explode(',', $paymate->getConfigData('dibspwlogos'));
		$sTrusted = '';
		$sCards = '';
		$iCards = 1;
		$iTrusted = 1;
		$sHTML = '';
		foreach($aLogoArray as $item) {
		    $mSecured = (boolean)preg_match("/^(DIBS|PCI|.*_SECURE.*)$/s", $item);
		    if($mSecured === TRUE){
		        $sTrusted .= $paymate->cms_get_imgHtml($item) . "&nbsp;&nbsp;";
		        //if($iTrusted%12 == 0) $sTrusted .= "<br />";
		        $iTrusted++;
		    }
		    else {
		        $sCards .= $paymate->cms_get_imgHtml($item) . "&nbsp;&nbsp;";
		        //if($iCards%12 == 0) $sCards .= "<br />";
		        $iCards++;
		    }
		}

		if(!empty($sTrusted)) $sHTML .= $sTrusted;
		if(!empty($sCards)) $sHTML .=  $sCards;
		$sHTML .=  ' '.Mage ::getStoreConfig('payment/Dibspw/title');
        $this->setTemplate('dibspw/dibspw/form.phtml')->setMethodTitle('')->setMethodLabelAfterHtml($sHTML);
    }
}

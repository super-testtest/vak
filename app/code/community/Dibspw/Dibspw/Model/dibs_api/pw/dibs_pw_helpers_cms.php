<?php
class dibs_pw_helpers_cms extends Mage_Payment_Model_Method_Abstract {   
    protected $_code  = 'Dibspw';
    protected $_formBlockType = 'Dibspw_Dibspw_Block_Form';
    protected $_infoBlockType = 'Dibspw_Dibspw_Block_Info';
    protected $_canUseInternal = false;
    protected $_canUseForMultishipping = false;
    
    public function cms_dibs_getOrderInfo() {
        $aPayInfo = array();
        $bMailing = false;
        $this->api_dibs_checkTable();
        $oOrder = Mage::registry('current_order');
        if($oOrder === NULL) {
            $oOrder = Mage::getModel('sales/order')->loadByIncrementId($_POST['orderid']);
            $bMailing = true;
        } 
        if($oOrder !== NULL &&  is_callable(array($oOrder, 'getIncrementId'))) {
            $iOid = $oOrder->getIncrementId();
            if(!empty($iOid)) {
                $oRead = Mage::getSingleton('core/resource')->getConnection('core_read');
                $aRow = $oRead->fetchRow("SELECT `status`, `transaction`, `paytype`, `fee` FROM `" . 
                                         Mage::getConfig()->getTablePrefix() . 
                                         dibs_pw_api::api_dibs_get_tableName() .
                                        "` WHERE `orderid` = " . $iOid . " LIMIT 1;");
                if(count($aRow) > 0) {
                    if($aRow['status'] == 'ACCEPTED') {
                        if($aRow['transaction'] != '0') {
                            $aPayInfo[Mage::helper('dibspw')->__('DIBSPW_LABEL_8')] = $aRow['transaction'];
                        }
                       
                        if($bMailing === FALSE) {
                            if(!empty($aRow['paytype'])) {
                                $aPayInfo[Mage::helper('dibspw')->__('DIBSPW_LABEL_12')] = $aRow['paytype'];
                            }
                        
                            if(!empty($aRow['fee'])) {
                                $aPayInfo[Mage::helper('dibspw')->__('DIBSPW_LABEL_11')] = 
                                            $oOrder->getOrderCurrencyCode() . "&nbsp;" . 
                                            number_format(((int) $aRow['fee']) / 100, 2, ',', ' ');
                            }
                        }
                    }
                    else $aPayInfo[Mage::helper('dibspw')->__('DIBSPW_LABEL_25')] = Mage::helper('dibspw')->__('DIBSPW_LABEL_19');
                }
            }
        }
        
        return $aPayInfo;
    }    
    
    public function cms_dibs_getAdminOrderInfo() {
        Mage::log(' === cms_dibs_getAdminOrderInfo === ',null,'setOrderStatusAfterPayment.log');
        $res = array();
        $this->api_dibs_checkTable();
        $oOrder = Mage::registry('current_order');
        if($oOrder !== NULL &&  is_callable(array($oOrder, 'getIncrementId'))) {
            $iOid = $oOrder->getIncrementId();
            if(!empty($iOid)) {
                $read = Mage::getSingleton('core/resource')->getConnection('core_read');
                $row = $read->fetchRow("SELECT `status`, `transaction`, `amount`, `currency`, `fee`, 
                                `paytype`, `ext_info` FROM " . Mage::getConfig()->getTablePrefix() .
                                dibs_pw_api::api_dibs_get_tableName() . "
                                WHERE orderid = " . $iOid . " LIMIT 1;");

                if(count($row) > 0) {
                    if($row['status'] == 'ACCEPTED') {
                        $row['ext'] = (isset($row['ext_info']) && $row['ext_info'] != NULL) ?
                                      unserialize($row['ext_info']) : array();
                        
                        if(!empty($row['transaction'])) {
                            $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_8')] = $row['transaction'];
                        }

                        if(!empty($row['amount'])) {
                            $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_9')] = $oOrder->getOrderCurrencyCode() . 
                                    "&nbsp;" . number_format(((int) $row['amount']) / 100, 2, ',', ' ');
                        }

                        if(!empty($row['currency'])) {
                            $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_10')] = $row['currency'];
                        }

                        if(!empty($row['fee'])) {
                            $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_11')] = $oOrder->getOrderCurrencyCode() . 
                                    "&nbsp;" . number_format(((int) $row['fee']) / 100, 2, ',', ' ');
                        }

                        if(!empty($row['paytype'])) {
                            $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_12')] = $row['paytype'];
                        }
                    
                        if($row['ext']['acquirer'] != '0') {
                            $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_16')] = $row['ext']['acquirer'];
                        }

                        if($row['ext']['enrolled'] != '0') {
                            $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_17')] = $row['ext']['enrolled'];
                        }

                        $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_25')] = Mage::helper('dibspw')->__('DIBSPW_LABEL_18') . 
                                ': <a href="https://payment.architrade.com/admin/">https://payment.architrade.com/admin/</a>';
                    }
                    else $res[Mage::helper('dibspw')->__('DIBSPW_LABEL_25')] = Mage::helper('dibspw')->__('DIBSPW_LABEL_19');
                }
            }
        }
        
        return $res;
    }
    
    public function cms_get_imgHtml($sLogo) {
        $sImgUrl = Mage::getDesign()->getSkinUrl('images/Dibspw/Dibspw/' . 
                                                 preg_replace("/(\(|\)|_)/s", "",
                                                 strtolower($sLogo)) . '.gif');
        return (file_exists("." . strstr($sImgUrl, "/skin/"))) ?
               '<img src="' . $sImgUrl . '" alt="' . htmlentities($sLogo) . '" />' : $sImgUrl;
    }

    public function setOrderStatusAfterPayment(){
        Mage::log(' === setOrderStatusAfterPayment === ',null,'setOrderStatusAfterPayment.log');
        $status = $_POST['status'];
        Mage::log('status: '.$status,null,'setOrderStatusAfterPayment.log');

        $infoMessage = "";
        switch($status) {
            case "ACCEPTED":
                $infoMessage = 'DIBSPW_LABEL_28';
                break;
            case "PENDING":
                $infoMessage = 'DIBSPW_LABEL_27';
                break;
            case "DECLINED":
                $infoMessage = 'DIBSPW_LABEL_29';
            break;
       }

       $infoMessage = Mage::helper('dibspw')->__($infoMessage); 
       $order = Mage::getModel('sales/order');
	   $order->loadByIncrementId($_POST['orderid']);
        
        if($status == "ACCEPTED") {
            $infoMessage .= ' Invoice has been generated';
            
            // Add fee to sales_order_table, if order has fee
            if( $_POST['fee'] ) {
                $order->setData('fee_amount', $_POST['fee']);
            }

            if(!$order->canInvoice()){
                Mage::log('Can not create invoice',null,'setOrderStatusAfterPayment.log');
                Mage::throwException(Mage::helper('core')->__('Cannot create an invoice.'));
            }
             
            $invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();
             
            if (!$invoice->getTotalQty()) {
                Mage::log('Cannot create an invoice without products',null,'setOrderStatusAfterPayment.log');
                Mage::throwException(Mage::helper('core')->__('Cannot create an invoice without products.'));
            }
             
            $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_OFFLINE);
            $invoice->register();
            $transactionSave = Mage::getModel('core/resource_transaction')
            ->addObject($invoice)
            ->addObject($invoice->getOrder());
             
            $transactionSave->save();
            Mage::log('Invoice Saved',null,'setOrderStatusAfterPayment.log');

            $order->setState($this->getConfigData('order_status_after_payment'),true,$infoMessage);
            $order->setStatus('betalt_dibs', false);
        } else {
          $order->addStatusHistoryComment($infoMessage);  
        }
	    $order->save();
        
    }
    
   /**
    * Removes items from stock, depends on 'handlestock' module configuration option
    * (used for successful payments)
    * 
    * http://www.magentocommerce.com/wiki/groups/132/protx_form_-_subtracting_stock_on_successful_payment
    */
    public function removeFromStock($iOrderId) {
      	$oSession = Mage::getSingleton('checkout/session');
     	$oSession->setDibspwStandardQuoteId($oSession->getQuoteId());
      
	$oOrder = Mage::getModel('sales/order');
	$oOrder->loadByIncrementId($iOrderId);

        if (((int)$this->getConfigData('handlestock')) == 1) {
            $oItems = $oOrder->getAllItems();
            if ($oItems) {
                foreach($oItems as $oItem) {
                    $oStock = Mage::getModel('cataloginventory/stock_item')
                                 ->loadByProduct($oItem->getProductId());
                    $oStock->setQty($oStock->getQty() - $oItem->getQtyOrdered());
                    $oStock->save();
                    continue;                        
                }
            }
        }
    }
}
?>
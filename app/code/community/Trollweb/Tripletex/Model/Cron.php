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
class Trollweb_Tripletex_Model_Cron
{

    protected $_tripletex = array();

    public function tripletex_export($scheduler)
    {
        $stores = Mage::app()->getStores();
        foreach ($stores as $store) {

            if (!Mage::getStoreConfig('tripletex/tripletex_settings/active',$store->getId())) {
                continue;
            }

            $collection = Mage::getModel('sales/order_invoice')->getCollection()
                  ->addFieldToSelect('*')
                  ->addAttributeToFilter('tripletex_exported',0)
                  ->addAttributeToFilter('store_id',$store->getId());

            $start_invoice = Mage::getStoreconfig('tripletex/tripletex_settings/start_invoice',$store->getId());

            if ((int)$start_invoice > 0) {
                $collection->addFieldToFilter('increment_id',array("gteq" => $start_invoice));
            }


            foreach ($collection->getItems() as $invoice) {
                $this->processInvoice($invoice);
            }

            Mage::getConfig()->cleanCache();
        }
    }

    public function processInvoice($invoice) {
        $tripletex = $this->getTripletex($invoice->getStoreId());

        $tripletex->addInvoice($invoice);
        $export_ok = false;
        if (Mage::getStoreconfig('tripletex/tripletex_settings/testmode',$invoice->getStoreId())) {
            if (!file_exists(Mage::getBaseDir('log').'/tripletex')) {
              @mkdir(Mage::getBaseDir('log').'/tripletex');
            }

            if ($tripletex->saveCsv(Mage::getBaseDir('log').'/tripletex/'.date("d-m-Y_his").'.csv')) {
                $export_ok = true;
            }
        }
        else {
            if ($tripletex->send()) {
                $export_ok = true;
                $invoice->setTripletexExported(1);
                $invoice->save();
            }
            else {
                // Set ERROR status.
                $invoice->setTripletexExported(2);
                $invoice->save();
            }
        }

        if ($export_ok) {
          $tripletex->log("Exporting invoice #".$invoice->getIncrementId()." successfull.");
        }
        else
        {
          $tripletex->log("Exporting invoice #".$invoice->getIncrementId()." failed.");
        }

        return $export_ok;
    }

    public function checkInvoiceStatus($scheduler) {
        $tripletex = Mage::getModel('tripletex/tripletex_invoice');

        $stores = Mage::app()->getStores();
        foreach ($stores as $store) {
            if (!Mage::getStoreConfig('tripletex/tripletex_settings/active',$store->getId())) {
                continue;
            }

            if (Mage::getStoreconfig('tripletex/tripletex_settings/transfermethod',$store->getId()) != Trollweb_Tripletex_Model_Config_Source_Transfermethods::METHOD_INVOICE) {
                // If the mode is set to transfer invoices as orders. Don't do the invoice check.
                continue;
            }

            if (!$tripletex->isAuthed()) {
              // Skip this store if we are not able to login.
              continue;
            }

          $collection = Mage::getModel('sales/order_invoice')->getCollection()
                ->addFieldToSelect('*')
                ->addAttributeToFilter('state',Mage_Sales_Model_Order_Invoice::STATE_OPEN)
                ->addAttributeToFilter('store_id',$store->getId());

          $start_invoice = Mage::getStoreconfig('tripletex/tripletex_settings/start_invoice',$store->getId());

          if ((int)$start_invoice > 0) {
            $collection->addFieldToFilter('increment_id',array("gteq" => $start_invoice));
          }

            foreach ($collection->getItems() as $invoice) {
              $amount = $tripletex->getOutstandingInvoiceAmount($invoice->getIncrementId());
              if ($amount == "0") {
                /* @var $invoice Mage_Sales_Model_Order_Invoice */
                if ($invoice->canCapture()) {
                  $tripletex->log('Faktura '.$invoice->getIncrementId().' står med beløp "'.$amount.'" i Tripletex og blir satt til ferdig');
                $invoice->capture();
              $invoice->getOrder()->setIsInProcess(true);
              $transactionSave = Mage::getModel('core/resource_transaction')
                  ->addObject($invoice)
                  ->addObject($invoice->getOrder())
                  ->save();
                }
              }
            }
        }
    }

    protected function getTripletex($storeId) {
      if (!isset($this->_tripletex[$storeId])) {
        if (Mage::getStoreconfig('tripletex/tripletex_settings/transfermethod',$storeId) == Trollweb_Tripletex_Model_Config_Source_Transfermethods::METHOD_ORDER) {
            $_method = Mage::getModel('tripletex/tripletex_order');
        }
        else {
            $_method = Mage::getModel('tripletex/tripletex_invoice');
        }
        $this->_tripletex[$storeId] = $_method;
      }

      return $this->_tripletex[$storeId];
    }

}


<?php

class Trollweb_Tripletex_ExportController extends Mage_Adminhtml_Controller_Action
{

  public function indexAction()
  {
    $ids = $this->getRequest()->getPost('invoice_ids');

    $tripletex = Mage::getModel('tripletex/cron');

    $completed = 0;
    $failed = 0;
    $skipped = 0;
    $skipped_not_active = 0;

    if (!empty($ids)) {
      foreach ($ids as $invoiceId)
      {

        $invoice = Mage::getModel('sales/order_invoice')->load($invoiceId);

        $store_id = $invoice->getStoreId();

        if (!Mage::getStoreConfig('tripletex/tripletex_settings/active',$store_id)) {
          $skipped_not_active++;
          continue;
        }

        if ($invoice->getTripletexExported() != Trollweb_Tripletex_Helper_Data::STATUS_NOT_EXPORTED) {
          $skipped++;
          continue;
        }

        if ($tripletex->processInvoice($invoice)) {
             $completed++;
        }
        else
        {
            $failed++;
        }
      }
    }

    if ($completed > 0) {
      $this->_getSession()->addSuccess(Mage::helper('tripletex')->__('%s fakturaer ble eksportert.',$completed));
    }

    if ($skipped > 0) {
      $this->_getSession()->addNotice(Mage::helper('tripletex')->__('%s fakturaer er allerede eksportert fra før.',$skipped));
    }

    if ($skipped_not_active > 0) {
      $this->_getSession()->addNotice(Mage::helper('tripletex')->__('%s fakturaer ble ikke eksportert pga at Tipletex ikke er aktivt for den butikken.',$skipped_not_active));
    }

    if ($failed > 0) {
      $this->_getSession()->addError(Mage::helper('tripletex')->__('%s fakturaer feilet under eksport. Sjekk loggfilene.',$failed));
    }

    Mage::getConfig()->cleanCache();

    $this->_redirect('adminhtml/sales_invoice');
  }

  public function transferredAction()
  {
    $ids = $this->getRequest()->getPost('invoice_ids');
    $completed = 0;
    $skipped = 0;

    if (!empty($ids)) {
      foreach ($ids as $invoiceId)
      {

        $invoice = Mage::getModel('sales/order_invoice')->load($invoiceId);
        if ($invoice->getTripletexExported() != Trollweb_Tripletex_Helper_Data::STATUS_EXPORTED) {
            $invoice->setTripletexExported(Trollweb_Tripletex_Helper_Data::STATUS_EXPORTED)->save();
            $completed++;
        }
        else {
            $skipped++;
        }

      }
    }

    if ($completed > 0) {
      $this->_getSession()->addSuccess(Mage::helper('tripletex')->__('%s fakturaer ble satt til status "Eksportert".',$completed));
    }

    if ($skipped > 0) {
      $this->_getSession()->addNotice(Mage::helper('tripletex')->__('%s fakturaer hadde allerede status "Eksportert" fra før.',$skipped));
    }

    Mage::getConfig()->cleanCache();

    $this->_redirect('adminhtml/sales_invoice');
  }

  public function resendAction()
  {
    $ids = $this->getRequest()->getPost('invoice_ids');
    $completed = 0;
    $skipped = 0;

    if (!empty($ids)) {
      foreach ($ids as $invoiceId)
      {

        $invoice = Mage::getModel('sales/order_invoice')->load($invoiceId);
        if ($invoice->getTripletexExported() != Trollweb_Tripletex_Helper_Data::STATUS_NOT_EXPORTED) {
            $invoice->setTripletexExported(Trollweb_Tripletex_Helper_Data::STATUS_NOT_EXPORTED)->save();
            $completed++;
        }
        else {
            $skipped++;
        }

      }
    }

    if ($completed > 0) {
      $this->_getSession()->addSuccess(Mage::helper('tripletex')->__('%s fakturaer ble satt til status "Ikke eksportert".',$completed));
    }

    if ($skipped > 0) {
      $this->_getSession()->addNotice(Mage::helper('tripletex')->__('%s fakturaer hadde allerede status "Ikke eksportert" fra før.',$skipped));
    }

    Mage::getConfig()->cleanCache();

    $this->_redirect('adminhtml/sales_invoice');
    
  }

}

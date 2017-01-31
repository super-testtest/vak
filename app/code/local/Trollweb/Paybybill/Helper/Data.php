<?php

class Trollweb_Paybybill_Helper_Data extends Mage_Core_Helper_Abstract
{

  public function checkCustomer($data)
  {
    $result = false;

    switch ($data['country']) {
      case 'DE':
      default:
        if ($data['ss_number'] == "03101980") {
          $result = true;
        }
    }

    return $result;
  }

  public function getOrderData($orderId)
  {
    $orderData = Mage::getModel('paybybill/orderdata')->loadByOrderId($orderId);

    if ($orderData) {
      return $orderData->getData();
    }
    else {
      return false;
    }
  }


  public function getInvoiceData($invoiceId)
  {
    $invoiceData = Mage::getModel('paybybill/invoicedata')->loadByInvoiceId($invoiceId);
    if ($invoiceData and $invoiceData->getId()) {
      return $invoiceData->getData();
    }
    else {
      return false;
    }
  }

}
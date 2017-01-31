<?php
class Trollweb_Paybybill_Model_Orderdata extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('paybybill/orderdata');
    }

    public function loadByOrderId($orderId)
    {
      $this->load($orderId,'order_id');
      if (!$this->getOrderId()) {
        $this->setOrderId($orderId);
      }
      return $this;
    }
}

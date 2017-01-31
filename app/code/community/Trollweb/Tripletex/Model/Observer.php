<?php
class Trollweb_Tripletex_Model_Observer
{

  public function addMassAction($observer) {
    $data = $observer->getEvent()->getBlock()->getData();
    if (isset($data['type']) &&
        $data['type'] == 'adminhtml/widget_grid_massaction' &&
        Mage::app()->getRequest()->getControllerName() === 'sales_invoice'
       ) {
        $observer->getEvent()->getBlock()->addItem('tripletex', array(
            'label'=> Mage::helper('sales')->__('Overfør til Tripletex'),
            'url' => Mage::app()->getStore()->getUrl('tripletex/export'),
        ));
        $observer->getEvent()->getBlock()->addItem('tripletex_exp', array(
            'label'=> Mage::helper('sales')->__('Sett Tripletex status til "Eksportert"'),
            'url' => Mage::app()->getStore()->getUrl('tripletex/export/transferred'),
        ));
        $observer->getEvent()->getBlock()->addItem('tripletex_not_exp', array(
            'label'=> Mage::helper('sales')->__('Sett Tripletex status til "Ikke eksportert"'),
            'url' => Mage::app()->getStore()->getUrl('tripletex/export/resend'),
        ));
       }
  }

    /**
     * Predispath admin action controller
     *
     * @param Varien_Event_Observer $observer
     */
    public function preDispatch(Varien_Event_Observer $observer)
    {
        if (Mage::getSingleton('admin/session')->isLoggedIn()) {
            $feedModel  = Mage::getModel('tripletex/feed');
            /* @var $feedModel Mage_AdminNotification_Model_Feed */
            $feedModel->checkUpdate();
        }
    }
}
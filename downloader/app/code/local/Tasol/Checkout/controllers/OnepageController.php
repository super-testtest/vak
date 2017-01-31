<?php 
/*
 * Overriding Mage_Checkout_OnepageController
 */
require_once(Mage::getModuleDir('controllers','Mage_Checkout').DS.'OnepageController.php');
class Tasol_Checkout_OnepageController extends Mage_Checkout_OnepageController
{
 
    public function successAction()
    {
        $session = $this->getOnepage()->getCheckout();
        if (!$session->getLastSuccessQuoteId()) {
            $this->_redirect('checkout/cart');
            return;
        }

        $lastQuoteId = $session->getLastQuoteId();
        $lastOrderId = $session->getLastOrderId();
        $lastRecurringProfiles = $session->getLastRecurringProfileIds();
        if (!$lastQuoteId || (!$lastOrderId && empty($lastRecurringProfiles))) {
            $this->_redirect('checkout/cart');
            return;
        }

        $session->clear();

        /* SOC :- Following will clear the cart after Order is placed => Magento Bug not clearing the cart*/
        foreach( Mage::getSingleton('checkout/session')->getQuote()->getItemsCollection() as $item )
        {
            Mage::getSingleton('checkout/cart')->removeItem( $item->getId() )->save();
        }
        /* EOC :- Following will clear the cart after Order is placed => Magento Bug not clearing the cart*/

        $this->loadLayout();
        $this->_initLayoutMessages('checkout/session');
        Mage::dispatchEvent('checkout_onepage_controller_success_action', array('order_ids' => array($lastOrderId)));
        $this->renderLayout();
    }
}
?>
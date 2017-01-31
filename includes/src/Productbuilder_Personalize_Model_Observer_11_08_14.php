<?php 
class Productbuilder_Personalize_Model_Observer
{
		public function saveAttributes(Varien_Event_Observer $observer)
        {
        	 $session = Mage::getSingleton('checkout/session');
        	 return $this;
        }

        public function removeTabs(Varien_Event_Observer $event)
		{
		    /*$block = $event->getBlock();

            //echo $productAttributeSetId = $product->getAttributeSetId();
		    if (!$block instanceof Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs) {
		        return;
		    }
		    //Hide the product builder Tab
			$product = Mage::registry('product');
			$productAttributeSetId = $product->getAttributeSetId();

                if ($productAttributeSetId == 10)//Product Builder Normal
                    $groupIdToHide = 33;
                if ($productAttributeSetId == 12)//Product Builder One Scissors
                    $groupIdToHide = 41;
                if ($productAttributeSetId == 13)//Product Builder One Scissors One Pen
                    $groupIdToHide = 49;
		    // TODO / Example: remove inventory tab
		    $block->removeTab('group_'.$groupIdToHide); 

		    // fix tab selection, as we might have removed the active tab
		    $tabs = $block->getTabsIds();

		    if (count($tabs) == 0) {
		        $block->setActiveTab(null);
		    } else {
		        $block->setActiveTab($tabs[0]);
		    }*/
	}
}
?>
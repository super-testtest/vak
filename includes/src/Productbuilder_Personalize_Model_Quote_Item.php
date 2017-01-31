<?php 
class Productbuilder_Personalize_Model_Quote_Item extends Mage_Sales_Model_Quote_Item
{
    /**
     * Check product representation in item
     *
     * @param   Mage_Catalog_Model_Product $product
     * @param   Mage_Sales_Model_Quote_Item
     * @return  bool
     */
    public function representProduct($product,$item=null)
    {

        $itemProduct = $this->getProduct();
        if (!$product || $itemProduct->getId() != $product->getId()) {
            return false;
        }
        /**
         * Check maybe product is planned to be a child of some quote item - in this case we limit search
         * only within same parent item
         */
        $stickWithinParent = $product->getStickWithinParent();
        if ($stickWithinParent) {
            if ($this->getParentItem() !== $stickWithinParent) {
                return false;
            }
        }

        // Check options
        $itemOptions = $this->getOptionsByCode();
        $productOptions = $product->getCustomOptions();

        if (!$this->compareOptions($itemOptions, $productOptions)) {
            return false;
        }
        if (!$this->compareOptions($productOptions, $itemOptions)) {
            return false;
        }

        //Parth Custom Code Start 26-6-14 : Solve Issue of Override of Custom Product
        if ($itemProduct->getTypeID() == 'customproduct' && $item != null)
        {
            $optionsCurrent    = $product->getCustomOptions();
            $jsonStringCurrent = $optionsCurrent['info_buyRequest']->getValue();
            $reqArrayCurrent   = unserialize($jsonStringCurrent);


            if (isset($reqArrayCurrent['prb_customized_image'])){
                return false;
            }

            if ($quote = $this->getQuote())
            {
                $options = $item->getProduct()->getCustomOptions();
                $jsonString = $options['info_buyRequest']->getValue();
                $reqArray = unserialize($jsonString);
                $result = array_diff($reqArrayCurrent,$reqArray);

                if(!empty($result)){
                    return false;
                }
              
            }

        }
        //Parth Custom Code End 26-6-14 : Solve Issue of Override of Custom Product

        return true;
    }
}
?>
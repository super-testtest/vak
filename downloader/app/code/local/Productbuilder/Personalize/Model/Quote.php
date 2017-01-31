<?php 
class Productbuilder_Personalize_Model_Quote extends Mage_Sales_Model_Quote
{
    /**
     * Retrieve quote item by product id
     *
     * @param   Mage_Catalog_Model_Product $product
     * @return  Mage_Sales_Model_Quote_Item || false
     */
    public function getItemByProduct($product)
    {
        foreach ($this->getAllItems() as $item) {
            if ($item->representProduct($product,$item)) {
                return $item;
            }
        }
        return false;
    }
}
?>
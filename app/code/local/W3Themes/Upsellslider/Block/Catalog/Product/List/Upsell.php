<?php
class W3Themes_Upsellslider_Block_Catalog_Product_List_Upsell extends Mage_Catalog_Block_Product_List_Upsell
{
    const XML_PATH_ITEM_LIMIT   = 'upsellslider/upsellslider_config/qty';
    public function getItemLimit($type = '')
    {
        return Mage::getStoreConfig(self::XML_PATH_ITEM_LIMIT);
    }
    /**
     * Get relevant path to template
     *
     * @return string
     */
    public function getTemplate()
    {
        return 'w3themes/upsellslider/upsell.phtml';
    }
}
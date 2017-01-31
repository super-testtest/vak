<?php
class W3Themes_Layerednavigationajax_Block_Catalogsearch_Layer_Filter_Attribute extends Mage_CatalogSearch_Block_Layer_Filter_Attribute
{
    public function __construct()
    {
        
        parent::__construct();
        
        $enableModule = Mage::helper('layerednavigationajax/data')->getStoreConfigField('enabled');
        if($enableModule){
            $this->setTemplate('w3themes/layerednavigationajax/attribute.phtml');
        }
    }
}
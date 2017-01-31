<?php

class W3Themes_Layerednavigationajax_Block_Catalog_Layer_Filter_Decimal extends Mage_Catalog_Block_Layer_Filter_Decimal {
      public function __construct()
    {
        parent::__construct();
        if(Mage::getStoreConfig('layerednavigationajax/layerfiler_config/enabled')){
            $this->setTemplate('w3themes/layerednavigationajax/attribute.phtml');
        }
    }
}

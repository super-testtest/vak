<?php
class W3Themes_Layerednavigationajax_Block_Catalog_Layer_Filter_Price extends Mage_Catalog_Block_Layer_Filter_Price {

    public $_currentCategory;
    public $_productCollection;
    public $_currMinPrice;
    public $_currMaxPrice;
    public $_searchSession;

    public function __construct() {

        $this->_currentCategory = Mage::registry('current_category');
        $this->_searchSession = Mage::getSingleton('catalogsearch/session');
        $this->setProductCollection();
        $this->setCurrentPrices();
        parent::__construct();
        if(Mage::getStoreConfig('layerednavigationajax/layerfiler_config/enabled')){
           $this->setTemplate('w3themes/layerednavigationajax/filter.phtml');
        }
        //Mage::getConfig()->getModuleConfig('W3Themes_Layerednavigationajax')->is('active', 'true');
    }

    public function getMaxRangePrice() {

        if ((isset($_GET['q']) && !isset($_GET['last'])) || !isset($_GET['q'])) {
            $direction = Mage::getBlockSingleton('catalog/product_list_toolbar')->getCurrentDirection();
            $isLoggedIn = Mage::getSingleton("customer/session")->isLoggedIn();
             if($direction == 'asc') 
             {
                if (!$isLoggedIn)
                {
                    $store = Mage::app()->getStore()->getCode();
                    if ($store == "nb")
                    {
                        $sku = $this->_productCollection->getLastItem()->getSku();
                        $productId = Mage::getModel("catalog/product")->getIdBySku($sku);
                        $_product = Mage::getModel('catalog/product')->load($productId);
                        $_store = $_product->getStore();
                        $_convertedFinalPrice = $_store->roundPrice($_store->convertPrice($_product->getFinalPrice()));
                        $_finalPriceInclTax = Mage::helper('tax')->getPrice($_product, $_convertedFinalPrice, true);
                        $_weeeTaxAmount = Mage::helper('weee')->getAmountForDisplay($_product);
                        $maxPrice = $_finalPriceInclTax + $_weeeTaxAmount;
                        $maxFormatted = Mage::helper('core')->formatPrice($_finalPriceInclTax + $_weeeTaxAmount, false);
                    }
                    else
                    {
                        $maxPrice = $this->_productCollection->getLastItem()->getFinalPrice();
                    }
                }
                else
                {
                    $maxPrice = $this->_productCollection->getLastItem()->getFinalPrice();
                }
             }
             else
             {
                if (!$isLoggedIn)
                {
                    $store = Mage::app()->getStore()->getCode();
                    if ($store == "nb")
                    {
                        $sku = $this->_productCollection->getFirstItem()->getSku();
                        $productId = Mage::getModel("catalog/product")->getIdBySku($sku);
                        $_product = Mage::getModel('catalog/product')->load($productId);
                        $_store = $_product->getStore();
                        $_convertedFinalPrice = $_store->roundPrice($_store->convertPrice($_product->getFinalPrice()));
                        $_finalPriceInclTax = Mage::helper('tax')->getPrice($_product, $_convertedFinalPrice, true);
                        $_weeeTaxAmount = Mage::helper('weee')->getAmountForDisplay($_product);
                        $maxPrice = $_finalPriceInclTax + $_weeeTaxAmount;
                        $maxFormatted = Mage::helper('core')->formatPrice($_finalPriceInclTax + $_weeeTaxAmount, false);
                    }
                    else
                    {
                        $maxPrice = $this->_productCollection->getFirstItem()->getFinalPrice();
                    }
                }
                else
                {
                    $maxPrice = $this->_productCollection->getFirstItem()->getFinalPrice();
                }
             }
        } else 
        {
            $maxPrice = $this->_searchSession->getMaxPrice();
        }

        return $maxPrice;
    }

    public function getMinRangePrice() {

        if ((isset($_GET['q']) && !isset($_GET['first'])) || !isset($_GET['q'])) {
             $direction = Mage::getBlockSingleton('catalog/product_list_toolbar')->getCurrentDirection();
             $isLoggedIn = Mage::getSingleton("customer/session")->isLoggedIn();
             if($direction == 'asc')
             {
                if (!$isLoggedIn)
                {
                    $store = Mage::app()->getStore()->getCode();
                    if ($store == "nb")
                    {
                        $sku = $this->_productCollection->getFirstItem()->getSku();
                        $productId = Mage::getModel("catalog/product")->getIdBySku($sku);
                        $_product = Mage::getModel('catalog/product')->load($productId);
                        $_store = $_product->getStore();
                        $_convertedFinalPrice = $_store->roundPrice($_store->convertPrice($_product->getFinalPrice()));
                        $_finalPriceInclTax = Mage::helper('tax')->getPrice($_product, $_convertedFinalPrice, true);
                        $_weeeTaxAmount = Mage::helper('weee')->getAmountForDisplay($_product);
                        $minPrice = $_finalPriceInclTax + $_weeeTaxAmount;
                        $minFormatted = Mage::helper('core')->formatPrice($_finalPriceInclTax + $_weeeTaxAmount, false);
                    }
                    else
                    {
                        $minPrice = $this->_productCollection->getFirstItem()->getFinalPrice();
                    }
                }
                else
                {
                    $minPrice = $this->_productCollection->getFirstItem()->getFinalPrice();
                }

             } 
             else
             {
                if (!$isLoggedIn)
                {
                    $store = Mage::app()->getStore()->getCode();
                    if ($store == "nb")
                    {
                        $sku = $this->_productCollection->getLastItem()->getSku();
                        $productId = Mage::getModel("catalog/product")->getIdBySku($sku);
                        $_product = Mage::getModel('catalog/product')->load($productId);
                        $_store = $_product->getStore();
                        $_convertedFinalPrice = $_store->roundPrice($_store->convertPrice($_product->getFinalPrice()));
                        $_finalPriceInclTax = Mage::helper('tax')->getPrice($_product, $_convertedFinalPrice, true);
                        $_weeeTaxAmount = Mage::helper('weee')->getAmountForDisplay($_product);
                        $minPrice = $_finalPriceInclTax + $_weeeTaxAmount;
                        $minFormatted = Mage::helper('core')->formatPrice($_finalPriceInclTax + $_weeeTaxAmount, false);
                    }
                    else
                    {
                      $minPrice = $this->_productCollection->getLastItem()->getFinalPrice();
                    }
                }
                else
                {
                  $minPrice = $this->_productCollection->getLastItem()->getFinalPrice();
                }
            }

            
        }
        else 
        {
            $minPrice = $this->_searchSession->getMinPrice();
        }
        return $minPrice;
    }

    public function setProductCollection() {
        $direction = Mage::getBlockSingleton('catalog/product_list_toolbar')->getCurrentDirection();
        if ($this->_currentCategory) {
            $this->_productCollection = $this->_currentCategory
                    ->getProductCollection()
                    ->addAttributeToSelect('*')
                    ->setOrder('price', $direction);
        } else {
            $this->_productCollection = Mage::getSingleton('catalogsearch/layer')
                    ->getProductCollection()
                    ->addAttributeToSelect('*')
                    ->setOrder('price', $direction);
        }
    }

    public function setCurrentPrices() {
        $rate = NULL;
        $direction = Mage::getBlockSingleton('catalog/product_list_toolbar')->getCurrentDirection();
        if(isset($_GET['rate'])){
            $rate = $this->getRequest()->getParam('rate'); 
        }
        $this->_currMinPrice = $this->getRequest()->getParam('first');
        $this->_currMaxPrice = $this->getRequest()->getParam('last');

        if (!$this->_currMaxPrice) {
            $curMax = $this->getMaxRangePrice();
            if($rate) {
                $curMax = $curMax/$rate;
            }
            
            $this->_currMaxPrice = $curMax;
        }
        
        if ((isset($_GET['q']) && !isset($_GET['first'])) || !isset($_GET['q'])) {
            if($direction == 'asc') {
                $searchMinPrice = $this->_productCollection->getFirstItem()->getFinalPrice();
            } else {
                $searchMinPrice = $this->_productCollection->getLastItem()->getFinalPrice();
            }
            if($rate) {
                $searchMinPrice = $searchMinPrice/$rate;
            }
            $this->_searchSession->setMinPrice($searchMinPrice);
        }


        if (!$this->_currMinPrice) {
            $curMin = $this->getMinRangePrice();
            if($rate) {
                $curMin = $curMin/$rate;    
            }
            $this->_currMinPrice = $curMin;
        }
        
        if ((isset($_GET['q']) && !isset($_GET['last'])) || !isset($_GET['q'])) {
            if($direction == 'asc') {
                $searchMaxPrice = $this->_productCollection->getLastItem()->getFinalPrice();
            } else {
                $searchMaxPrice = $this->_productCollection->getFirstItem()->getFinalPrice();
            }
            if($rate) {
                $searchMaxPrice = $searchMaxPrice/$rate;
            }
            $this->_searchSession->setMaxPrice($searchMaxPrice);
        }
    }

}

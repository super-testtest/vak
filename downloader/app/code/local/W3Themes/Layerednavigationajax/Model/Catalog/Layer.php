<?php

class W3Themes_Layerednavigationajax_Model_Catalog_Layer extends Mage_Catalog_Model_Layer {

    public function getProductCollection() {
        if (isset($this->_productCollections[$this->getCurrentCategory()->getId()])) {
            $collection = $this->_productCollections[$this->getCurrentCategory()->getId()];
        } else {
            $collection = $this->getCurrentCategory()->getProductCollection();
            $this->prepareProductCollection($collection);
            $this->_productCollections[$this->getCurrentCategory()->getId()] = $collection;
        }
        $fisrt = NULL;
        $last = NULL;
        if (isset($_GET['last'])) {
            $last = $_GET['last'];
        }
        if (isset($_GET['first'])) {
            $fisrt = $_GET['first'];
        }
        if(isset( $_GET['rate'])){
            $rate = $_GET['rate'];
            $last = $last / $rate;
            $fisrt = $fisrt / $rate;
        }

        if (!Mage::getSingleton("customer/session")->isLoggedIn())
        {
            if(Mage::app()->getStore()->getCode() == "nb")
            {
                $fisrt = $fisrt - $fisrt/5;
                $last = $last - $last/5;                
            }

        }

        
        if ($fisrt && $last) {
            $collection
                    ->addFieldToFilter('price', array('gteq' => $fisrt))
                    ->addFieldToFilter('price', array('lteq' => $last));
        }

        return $collection;
    }

}

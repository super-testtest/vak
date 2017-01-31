<?php 
class Productbuilder_Personalize_Block_Builder extends Mage_Catalog_Block_Product_List
{
    /**
     * Product Collection
     *
     * @var Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected $_productCollection;

    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) 
        {
            $cat_id = $this->getCategoryId();
            $category = Mage::getModel('catalog/category')->load($cat_id);
            $collection =   $category
                            ->getProductCollection()
                            ->addAttributeToSelect('*')
                            ->addAttributeToFilter('type_id', array('eq' => 'customproduct'))
                            ->addAttributeToFilter('status',1)
                            ->addAttributeToSort('position');

			/*$collection = Mage::getResourceModel('catalog/product_collection')
				          ->addAttributeToSelect('*')
				          ->addAttributeToFilter('type_id', array('eq' => 'customproduct'))
				          ->addAttributeToFilter('status',1)
				          ->addAttributeToSort('id','ASC')*/
				          /*->setPageSize(9)
				          ->setCurPage(1)*/;
			return $collection;
        }

        return $this->_productCollection;
    }
}
?>
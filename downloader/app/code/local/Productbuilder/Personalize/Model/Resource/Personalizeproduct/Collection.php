<?php
class Productbuilder_Personalize_Model_Resource_Personalizeproduct_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct() {
       $this->_init('personalize/personalizeproduct');
    }
}
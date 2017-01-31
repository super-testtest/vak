<?php
class Productbuilder_Personalize_Model_Resource_Personalizeproduct extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('personalize/personalizeproduct', 'entity_id');
    }
}
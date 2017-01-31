<?php

class Trollweb_Paybybill_Model_System_Config_Backend_Socialtitle extends Mage_Adminhtml_Model_System_Config_Backend_Serialized_Array
{
    /**
     * Prepare data before save
     */
    protected function _beforeSave()
    {
        $value = $this->getValue();
        if (is_array($value)) {
            unset($value['__empty']);

            $methods = array();
            foreach ($value as $key => $val) {
              // Remove duplicate shipping methods
              if (in_array($val['social_title'],array_keys($methods))) {
                unset($value[$key]);
              }
              else {
                $methods[$val['social_title']] = $val['pbb_social_title'] ;
              }
            }
            $this->setValue($value);
            parent::_beforeSave();
        }
    }

}

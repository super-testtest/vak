<?php
/**
 * Tripletex Integration
 *
 * LICENSE AND USAGE INFORMATION
 * It is NOT allowed to modify, copy or re-sell this file or any
 * part of it. Please contact us by email at post@trollweb.no or
 * visit us at www.trollweb.no/bbs if you have any questions about this.
 * Trollweb is not responsible for any problems caused by this file.
 *
 * Visit us at http://www.trollweb.no today!
 *
 * @category   Trollweb
 * @package    Trollweb_Tripletex
 * @copyright  Copyright (c) 2010 Trollweb (http://www.trollweb.no)
 * @license    Single-site License
 *
 */

class Trollweb_Tripletex_Model_Config_Backend_Paymentmethods extends Mage_Adminhtml_Model_System_Config_Backend_Serialized_Array
{
    /**
     * Prepare data before save
     */
    protected function _beforeSave()
    {
        $value = $this->getValue();
        if (is_array($value)) {
            unset($value['__empty']);

            $stores = array();
            foreach ($value as $k => $v) {
              if (!empty($v['tripletex_method'])) {
                $stores[$k] = $v;
              }
            }
            $this->setValue($stores);
            parent::_beforeSave();
        }
    }
}
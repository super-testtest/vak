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

class Trollweb_Tripletex_Model_Config_Backend_Cronimportinterval
{

    public function toOptionArray()
    {
        $intervals = array(
            array(
                'label' => Mage::helper('tripletex')->__('Daglig (Kjører 23:00)'),
                'value' => 'daily'
            ),
            array(
                'label' => Mage::helper('tripletex')->__('Hver 12 time (kjører 01:00 og 13:00)'),
                'value' => '12hour'
            ),
            array(
                'label' => Mage::helper('tripletex')->__('Hver hele time'),
                'value' => 'hourly'
            ),
                          );

        return $intervals;
    }
}
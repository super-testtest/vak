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
 * @copyright  Copyright (c) 2013 Trollweb (http://www.trollweb.no)
 * @license    Single-site License
 *
 */

class Trollweb_Tripletex_Model_Config_Source_Vatcodes
{

    public function toOptionArray()
    {
        $vatcodes = array(
            array(
                'label' => Mage::helper('tripletex')->__('Høy sats (3)'),
                'value' => 3
            ),
            array(
                'label' => Mage::helper('tripletex')->__('Middels sats (31)'),
                'value' => 31
            ),
            array(
                'label' => Mage::helper('tripletex')->__('Lav sats (32)'),
                'value' => 32
            ),
            array(
                'label' => Mage::helper('tripletex')->__('Avgiftsfritt (5)'),
                'value' => 5
            ),

                          );

        return $vatcodes;
    }
}
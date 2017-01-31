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

class Trollweb_Tripletex_Block_Adminhtml_Sales_Invoice_Grid extends Mage_Adminhtml_Block_Sales_Invoice_Grid
{
		protected function _prepareColumns()
    {
 				$this->addColumnAfter('tripletex_exported', array(
				            'header'    => Mage::helper('tripletex')->__('Tripeltex'),
										'index'			=> 'tripletex_exported',
				            'type'      => 'options',
										'options'   => Mage::helper('tripletex')->getStatuses(),
																												),
															'grand_total');

				return parent::_prepareColumns();
    }
}
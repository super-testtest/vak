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

$installer = $this;

$installer->startSetup();

$attribute_settings = array(
		'label'         => 'Tripletex Kundenummer',
    'type'          => 'varchar',
    'input'         => 'text',
		'visible'       => true,
    'required'      => false,
    'user_defined'  => true,
		'position'			=> 199,
    'visible_on_front' => false
                           );

$installer->addAttribute('customer', 'tripletex_customernumber', $attribute_settings);

// Add to form.
$store = Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID);

/* @var $eavConfig Mage_Eav_Model_Config */
$eavConfig = Mage::getSingleton('eav/config');
$attribute = $eavConfig->getAttribute('customer', 'tripletex_customernumber');
$attribute->setWebsite($store->getWebsite());
$attribute->addData(array(
				'is_user_defined'   => 1,
        'is_system'         => 0,
        'is_visible'        => 1,
        'sort_order'        => 199,
        'is_required'       => 0,
        'used_in_forms'			=> array('adminhtml_customer')
                         ));
$attribute->save();

$installer->endSetup();

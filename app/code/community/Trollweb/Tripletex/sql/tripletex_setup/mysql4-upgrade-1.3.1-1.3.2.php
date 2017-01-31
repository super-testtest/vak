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

$attributeParams = array(
    'label'     => 'Email',
    'type'      => 'varchar',
    'input'     => 'text',
    'is_user_defined' => 1,
);

$installer->addAttribute('customer_address', 'tripletex_invoice_email', $attributeParams);

$attribute = Mage::getSingleton('eav/config')->getAttribute('customer_address', 'tripletex_invoice_email');
$attribute->addData(
    array(
        'is_system'         => 0,
        'is_visible'        => 1,
        'sort_order'        => 200,
        'is_required'       => 0,
        'validate_rules' => array(
            'input_validation' => 'email',
        ),
        'used_in_forms', array(
            'adminhtml_customer_address',
            'customer_address_edit',
            'customer_register_address'
        ),
    )
);
$attribute->save();

$installer->endSetup();

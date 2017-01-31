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

$table = $this->getTable('sales_flat_invoice');
$query = 'ALTER TABLE `' . $table . '` ADD COLUMN `tripletex_exported` INT(1) DEFAULT 0 COMMENT \'Tripletex Export\'';
$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
$connection->query($query);

$table = $this->getTable('sales_flat_invoice_grid');
$query = 'ALTER TABLE `' . $table . '` ADD COLUMN `tripletex_exported` INT(1) DEFAULT 0 COMMENT \'Tripletex Export\'';
$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
$connection->query($query);


// For enterprise
$table = $this->getTable('enterprise_sales_invoice_grid_archive');
if ($installer->tableExists($table)) {
  $query = 'ALTER TABLE `' . $table . '` ADD COLUMN `tripletex_exported` INT(1) DEFAULT 0 COMMENT \'Tripletex Export\'';
  $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
  $connection->query($query);
}

$installer->endSetup();

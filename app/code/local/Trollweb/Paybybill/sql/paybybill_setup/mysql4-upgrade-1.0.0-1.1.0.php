<?

$installer = $this;

$installer->startSetup();

$tables = array($this->getTable('paybybill_orderdata'),
                $this->getTable('paybybill_invoicedata')
               );

foreach ($tables as $table) {
  $installer->run("ALTER TABLE {$table} ADD COLUMN bank_id varchar(100) DEFAULT ''");
  $installer->run("ALTER TABLE {$table} ADD COLUMN bank_account varchar(100) DEFAULT ''");
}


$installer->endSetup();
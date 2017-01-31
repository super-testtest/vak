<?

$installer = $this;

$installer->startSetup();
$installer->run("

CREATE TABLE IF NOT EXISTS {$this->getTable('paybybill_orderdata')} (
  `orderdata_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT NULL,
  `cust_no` int(10) DEFAULT NULL,
  `credit_limit` float(7,4) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `reservation_id` varchar(255) DEFAULT NULL,
  `invoice_fee` float(7,4) DEFAULT 0,
  `invoice_fee_tax` float(7,4) DEFAULT 0,
  `invoice_fee_invoiced` float(7,4) DEFAULT 0,
  `invoice_fee_tax_invoiced` float(7,4) DEFAULT 0,
  PRIMARY KEY (`orderdata_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS {$this->getTable('paybybill_invoicedata')} (
  `invoicedata_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `kid` varchar(255) DEFAULT NULL,
  `invoice_fee` float(7,4) DEFAULT 0,
  `invoice_fee_tax` float(7,4) DEFAULT 0,
  PRIMARY KEY (`invoicedata_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->endSetup();
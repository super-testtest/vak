<?

$installer = $this;

$installer->startSetup();


$statusTable        = $installer->getTable('sales/order_status');
$statusStateTable   = $installer->getTable('sales/order_status_state');

$data = array(
    array('status' => 'pending_invoice', 'label' => 'Pending Batch Invoice')
);
$installer->getConnection()->insertArray($statusTable, array('status', 'label'), $data);

$data = array(
    array('status' => 'pending_invoice', 'state' => 'processing', 'is_default' => 0)
);
$installer->getConnection()->insertArray($statusStateTable, array('status', 'state', 'is_default'), $data);


$installer->endSetup();
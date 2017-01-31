<?php

$paidorderids = array();

$file = fopen("invoices.csv","r");

while(! feof($file))
{
	$inv_data = fgetcsv($file);
	if($inv_data['2'] != ''){
		$paidorderids[$inv_data['2']] = '';	
	}
	
	
}
fclose($file);


$file_order = fopen("orders.csv","r");

$i = 0;
while(! feof($file_order))
{
	$i++;
	
	if($i == 1) continue;

	$order_data = fgetcsv($file_order);
	if($file_order['0'] != ''){
		$order_id = $file_order['0'];
		$gtbase = $file_order['5'];
		if(isset($paidorderids[$order_id])){
			$paidorderids[$order_id] = $gtbase;
		}
	}
}
fclose($file_order);

echo '<pre>';print_r($paidorderids);exit;

?>
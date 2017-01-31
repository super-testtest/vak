<?php
	

	require '../app/Mage.php';
	Mage::app('admin');
	Mage::register('isSecureArea', 1);
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	error_reporting(E_ALL);
	set_time_limit(0);
	ini_set('memory_limit','1024M');

	$salesModel=Mage::getModel("sales/order");
	$salesCollection = $salesModel->getCollection();
	$cnt = 1;
	foreach($salesCollection as $order)
	{
		$payment_method = $order->getPayment()->getMethodInstance()->getTitle();
		if($payment_method == 'PayPal'){

			$isEmailSent = 'Email Not Sent';
			if ($order->getEmailSent()) {
				$isEmailSent = 'Email Sent'; 
			}   
			

			$orderId= $order->getIncrementId();
			$status = $order->getStatusLabel();
			echo $cnt.') '.$orderId.' ==> '.$payment_method.' ==> '.$status.' ==> '.$isEmailSent.'<br/>';
			$cnt++;
		}
	}

	// 800000024
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
		$payment_method = $order->getPayment()->getMethodInstance()->getCode();
			
		$state = $order->getState();

		if($payment_method == 'paypal_standard' && $state == "processing"){

			$orderId= $order->getIncrementId();
			$order->setStatus("betalt_paypal");
			$order->save();
			Mage::log($orderId,null,'paypal.log');
		}

		if($payment_method == 'Dibspw' && $state == "processing"){

			$orderId= $order->getIncrementId();
			$order->setStatus("betalt_dibs");
			$order->save();
			Mage::log($orderId,null,'dibs.log');
		}

		if($payment_method == 'pbbinvoice' && $state == "processing"){

			$orderId= $order->getIncrementId();
			$order->setStatus("betalt_afterpay");
			$order->save();
			Mage::log($orderId,null,'afterpay.log');
		}
	}
	echo 'success';exit;
	// 800000024
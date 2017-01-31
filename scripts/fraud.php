<?php 
	
	require '../app/Mage.php';
	Mage::app('admin');
	Mage::register('isSecureArea', 1);
	error_reporting(E_ALL);
	set_time_limit(0);
	ini_set('memory_limit','1024M');

	
		

	$order = Mage::getModel('sales/order')->loadByIncrementId('100000039');


	$payment = $order->getPayment();

            // $payment->setAdditionalData('Test Order','Yes');
            // $payment->save();

            echo '<pre>';print_r($payment->getData());exit;

	try {
		
		if(!$order->canInvoice()){
		
			Mage::throwException(Mage::helper('core')->__('Cannot create an invoice.'));

		}
		 
		$invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();
		 
		if (!$invoice->getTotalQty()) {
		
			Mage::throwException(Mage::helper('core')->__('Cannot create an invoice without products.'));
		}
		 
		$invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
		$invoice->register();
		$transactionSave = Mage::getModel('core/resource_transaction')
		->addObject($invoice)
		->addObject($invoice->getOrder());
		 
		$transactionSave->save();
		
		$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
		
		if($payment_method == 'paypal_standard'){
					
			$order->setStatus('betalt_paypal', false);
		}
		if($payment_method == 'Dibspw'){
			
			$order->setStatus('betalt_dibs', false);
		}
		if($payment_method == 'pbbinvoice'){
			
			$order->setStatus('befalt_afterpay', false);
		}
		$order->save();
		
	}
	catch (Mage_Core_Exception $e) {
		echo '<pre>';print_r($e);exit;
		
	}
	
?>
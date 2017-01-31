<?php
class Tailored_PaypalAutoInvoice_Model_Observer
{
	public function generateInvoice(Varien_Event_Observer $observer)
	{
		Mage::log(Mage::getSingleton('checkout/session')->getLastOrderId(),null,'Autoinvoicegenrrate.log');
		if(Mage::getSingleton('checkout/session')->getLastOrderId() != ''){

			$order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());
			Mage::log('Order No: '.$order->getIncrementId(),null,'Autoinvoicegenrrate.log');

			Mage::log('Order No: '.$order->getIncrementId(),null,'track_order.log');
			Mage::log($_SERVER,null,'track_order.log');

			$payment_method = $order->getPayment()->getMethodInstance()->getCode();
			
			$methods = array(
				'paypal_standard',
				'Dibspw',
				'pbbinvoice'
			);


			if(in_array($payment_method, $methods)){
				try {
					
					Mage::log('===================== Order Process start ========================',null,'Autoinvoicegenrrate.log');
					Mage::log('Order No: '.$order->getIncrementId(),null,'Autoinvoicegenrrate.log');

					$state = $order->getState();
					Mage::log('state: '.$state,null,'Autoinvoicegenrrate.log');
					if($state == 'payment_review'){
						$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
						$order->save();
						Mage::log('state changed',null,'Autoinvoicegenrrate.log');
						$order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());
					}
					
					Mage::log('payment_method: '.$payment_method,null,'Autoinvoicegenrrate.log');
					
					if($payment_method == 'paypal_standard'){

						if(!$order->canInvoice()){
							Mage::log('Can not create invoice',null,'Autoinvoicegenrrate.log');
							Mage::log('Cannot create an invoice.',null,'AutoInvoice.log');
							Mage::throwException(Mage::helper('core')->__('Cannot create an invoice.'));

						}
						 
						$invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();
						 
						if (!$invoice->getTotalQty()) {
							Mage::log('Cannot create an invoice without products',null,'Autoinvoicegenrrate.log');
							Mage::throwException(Mage::helper('core')->__('Cannot create an invoice without products.'));
						}
						 
						$invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
						$invoice->register();
						$transactionSave = Mage::getModel('core/resource_transaction')
						->addObject($invoice)
						->addObject($invoice->getOrder());
						 
						$transactionSave->save();
						Mage::log('Invoice Saved',null,'Autoinvoicegenrrate.log');
						
						if (!$order->getEmailSent()) {
							try {
								$order->sendNewOrderEmail();
								Mage::log('Email Sent',null,'Autoinvoicegenrrate.log');
							} catch (Exception $e) {
							    Mage::log($e,null,'PaypalOrderEmail.log');
							}	
						}
						$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
						Mage::log('Payapl status',null,'Autoinvoicegenrrate.log');
						$order->setStatus('betalt_paypal', false);
					}
					
					if($payment_method == 'pbbinvoice'){
						$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
						Mage::log('pbbinvoice status',null,'Autoinvoicegenrrate.log');
						$order->setStatus('befalt_afterpay', false);
					}
					
					$order->save();
					Mage::log('Order saved successfully',null,'Autoinvoicegenrrate.log');
				}
				catch (Mage_Core_Exception $e) {
					Mage::log($e,null,'generateInvoice.log');	 
				}	
			}	
		}
		else{
			Mage::log('Order id not found',null,'Autoinvoicegenrrate.log');
		}

		
	}

	function clearCart(){
		Mage::getSingleton('checkout/cart')->truncate();
		Mage::getSingleton('checkout/cart')->save();
	}
}

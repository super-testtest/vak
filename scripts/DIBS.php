<?php 
	
        
    


    require '../app/Mage.php';
    Mage::app('admin');
    Mage::register('isSecureArea', 1);
    error_reporting(E_ALL);
    set_time_limit(0);
    ini_set('memory_limit','1024M');



    $collection = Mage::getModel('cms/page')
        ->getCollection()
        ->getSelect()
        ->where('is_active = 1');

        echo '<pre>';print_r(count($collection));exit;
    foreach ($collection as $product) {
        echo '<pre>';print_r($product);
    }


    exit;
    $salesModel=Mage::getModel("sales/order");
    $salesCollection = $salesModel->getCollection();
    $cnt = 1;
    foreach($salesCollection as $order)
    {
       
        $payment_method = $order->getPayment()->getMethodInstance()->getCode();
        $hasInvoices = false;
       
        // if ($order->hasInvoices()) {
            // $hasInvoices = true;
            // $invIncrementId = array();
            // foreach ($order->getInvoiceCollection() as $invoice) {
            //     $invoiceIncId[$orderId.$payment_method] = $invoice->getIncrementId();
            // }
            // echo '<pre>';print_r($invoiceIncId);
        // }

        // $status = $order->getStatusLabel();
        if($status == 'Betalt'){
            $orderId= $order->getIncrementId();
            $status = $order->getStatusLabel();
            echo $cnt.') '.$orderId.' ==> '.$payment_method.' ==> '.$status.'<hr/>';
            $cnt++;            
        }
        
        // if($payment_method == 'pbbinvoice'){

        //     $orderId= $order->getIncrementId();
        //     $status = $order->getStatusLabel();
        //     echo $cnt.') '.$orderId.' ==> '.$payment_method.' ==> '.$status.'<hr/>';
        //     $cnt++;
        // }


        // $status = $order->getStatusLabel();
        // if($status == 'Suspected Fraud'){
        //     $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
        //     if($payment_method == 'paypal_standard'){

        //         $orderId= $order->getIncrementId();
        //         $order->setStatus("betalt_paypal");
        //         $order->save();
        //         Mage::log($orderId,null,'paypal.log');
        //     }

        //     if($payment_method == 'Dibspw'){

        //         $orderId= $order->getIncrementId();
        //         $order->setStatus("betalt_dibs");
        //         $order->save();
        //         Mage::log($orderId,null,'dibs.log');
        //     }

        //     if($payment_method == 'pbbinvoice'){

        //         $orderId= $order->getIncrementId();
        //         $order->setStatus("betalt_afterpay");
        //         $order->save();
        //         Mage::log($orderId,null,'afterpay.log');
        //     }

        //     // $orderId= $order->getIncrementId();
        //     // $status = $order->getStatusLabel();
        //     // echo $cnt.') '.$orderId.' ==> '.$payment_method.' ==> '.$status.'<hr/>';
        //     // $cnt++;            
        // }
    }
    echo 'Done';
?>


<!-- 1) 865 ==> paypal_standard ==> Suspected Fraud
2) 869 ==> paypal_standard ==> Suspected Fraud
3) 871 ==> paypal_standard ==> Suspected Fraud -->
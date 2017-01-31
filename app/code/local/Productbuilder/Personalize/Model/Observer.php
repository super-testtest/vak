<?php
class Productbuilder_Personalize_Model_Observer
{
    /**
     * Flag to stop observer executing more than once
     *
     * @var static bool
     */
    static protected $_singletonFlag = false;

    public function updateProductPrice(Varien_Event_Observer $observer){
        $item = $observer->getQuoteItem();
        if ($item->getParentItem()) {
            $item = $item->getParentItem();
        }

        // Discounted 25% off
        $percentDiscount = 0.25;

        // This makes sure the discount isn't applied over and over when refreshing
        $specialPrice = $item->getOriginalPrice() - ($item->getOriginalPrice() * $percentDiscount);

        // Make sure we don't have a negative
        if ($specialPrice > 0) {
            $item->setCustomPrice($specialPrice);
            $item->setOriginalCustomPrice($specialPrice);
            $item->getProduct()->setIsSuperMode(true);
        }
    }

	public function saveAttributes(Varien_Event_Observer $observer)
    {
    	 $session = Mage::getSingleton('checkout/session');
    	 return $this;
    }

    /**
     * This method will run when the product is saved from the Magento Admin
     * Use this function to update the product model, process the
     * data or anything you like
     *
     * @param Varien_Event_Observer $observer
     */
    public function saveProductTabData(Varien_Event_Observer $observer)
    {
        if (!self::$_singletonFlag) {
            self::$_singletonFlag = true;

            $product = $observer->getEvent()->getProduct();

            if($_FILES['previewImage']['name'])
            {
              try
              {

                $uploader = new Varien_File_Uploader('previewImage');

                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));

                $uploader->setAllowRenameFiles(true);

                $uploader->setFilesDispersion(false);

                $path = Mage::getBaseDir('media').'/catalog/product/previewImage' ;

                $now = time();
                $newName = $now.'_'.$_FILES['previewImage']['name'];
                $newName = $uploader-> getCorrectFileName($newName);
                if ($product->getPreviewImage())
                {
                	$oldImage = $path.'/'.$product->getPreviewImage();
                	@unlink($oldImage);
                }

                $uploader->save($path, $newName);

                $product->setPreviewImage($newName);
                $product->save();
              }
                catch(Exception $e)
                {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }
        }
    }

    /**
     * Retrieve the product model
     *
     * @return Mage_Catalog_Model_Product $product
     */
    public function getProduct()
    {
        return Mage::registry('product');
    }

    /**
     * Shortcut to getRequest
     *
     */
    protected function _getRequest()
    {
        return Mage::app()->getRequest();
    }

    public function indexcron()
    {
        Mage::log('============== Cron Run ==============',null,'cronjobdetails.log');

        $baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $toDate  = Mage::getSingleton('core/date')->gmtDate('Y-m-d H:i:s');

        $days = 1;
        $today = date('l');

        $read= Mage::getSingleton('core/resource')->getConnection('core_read');
        $write = Mage::getSingleton('core/resource')->getConnection('core_write');

        $value=$read->query("select * from cron_job_table");
        $row = $value->fetch();

        $rowID = $row['1'];
        $fromDate = $row['lastrun'];
        Mage::log('To Date: '.$toDate,null,'cronjobdetails.log');
        Mage::log('From Date: '.$fromDate,null,'cronjobdetails.log');
        Mage::log('Row ID: '.$rowID,null,'cronjobdetails.log');

        /* Get the collection */
        $orders = Mage::getModel('sales/order_item')->getCollection()->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate));

        $salesModel=Mage::getModel("sales/order_item");
        $salesCollection = $salesModel->getCollection();
        $items = array();
        $inc = 1;

        foreach($orders as $order)
        {
            $orderFull = Mage::getModel('sales/order')->load($order->getOrderId());

            $orderStatus = $orderFull->getStatus();

            $attributes = $order->getProductOptions();

            if (isset($attributes['info_buyRequest']['prb_customized_image']) && $orderStatus != 'pending_payment' && $orderStatus != 'canceled')
            {
                $items[$inc] = $order;
                $inc++;
            }

            $orderId= $order->getOrderId();
        }

        $count = count($items);
        Mage::log('Count: '.$count,null,'cronjobdetails.log');
        if ($count and $count > 0)
        {
            require_once("lib/ExcelClasses/PHPExcel.php");
            // Create an instance
            $workbook = new PHPExcel;
            $sheet = $workbook->getActiveSheet();
            $boldArray = array(
                'font' => array(
                    'bold' => true,
                    'size' => 12,
                ),
            );
            $borderArray = array(
                'borders' => array(
                    'left' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                    ),
                    'right' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                    ),
                ),
            );


            $bottomStart = $count+3;
            $bottomEnd   = $count+7;
            $sheet->getStyle('A1:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $sheet->getStyle('A1:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $sheet->getStyle('A1:I4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('A1:I4')->applyFromArray(array('font' => array('size' => 16)));

            // Footer - Start
            $sheet->setCellValue('A1','Requested by:  Vaktrommet As');
            $sheet->mergeCells('A1:F4');

            $sheet->setCellValue('G1','Date:  '.date("d-m-Y",mktime(date('h'),date('i'),date('s'),date('m'),date('d')-1,date('Y'))).'');
            $sheet->mergeCells('G1:I4');
            // Footer - End

            $sheet->getStyle('A6:N6')->applyFromArray($boldArray);
            $sheet->getStyle('A7:N7')->applyFromArray(array('font' => array('size' => 12)));

            $sheet->getColumnDimension('J')->setWidth(20);
            $sheet->getColumnDimension('M')->setWidth(20);
            $sheet->getColumnDimension('N')->setWidth(25);
            $sheet->getRowDimension('6')->setRowHeight(20);
            $sheet->getRowDimension('7')->setRowHeight(20);

            $sheet->getStyle('A6:N6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A6:N6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

            $sheet->getStyle('B6:N6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');

            $sheet->getStyle('A6:A7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('B6:E7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('B6:E6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('F6:I7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('F6:I6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('J6:J7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('J6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('K6:K7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('K6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('L6:L7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('L6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('M6:M7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('M6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('N6:N7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('N6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            // //Header row 1 - Start
            $sheet->setCellValue('A6','Badge');
            $sheet->mergeCells('A6:A7');

            $sheet->setCellValue('B6','Text');
            $sheet->mergeCells('B6:E6');

            $sheet->setCellValue('F6','Title');
            $sheet->mergeCells('F6:I6');

            $sheet->setCellValue('J6','Background Color');

            $sheet->setCellValue('K6','Image');

            $sheet->setCellValue('L6','Emotion');

            $sheet->setCellValue('M6','Preview Image');

            $sheet->setCellValue('N6','High Resolution Image');
            // //Header row 1 - End

            // //Header row 2 - Start
            $sheet->setCellValue('B7','Name');

            $sheet->setCellValue('C7','Font-Size');

            $sheet->setCellValue('D7','Color');

            $sheet->setCellValue('E7','Font-Style');

            $sheet->setCellValue('F7','Name');

            $sheet->setCellValue('G7','Font-Size');

            $sheet->setCellValue('H7','Color');

            $sheet->setCellValue('I7','Font-Style');

            $sheet->setCellValue('J7','Color');

            $sheet->setCellValue('K7','');

            $sheet->setCellValue('L7','');

            $sheet->setCellValue('M7','');

            // //Header row 2 - End

            // //Record View - Start
            $alphabetArray = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N");
            $orderModel = Mage::getModel('sales/order');



            for($i=1;$i<=$count;$i++) {
                for($j=0;$j<count($alphabetArray);$j++) {
                    $cellRow = $i+7;
                    $index = $alphabetArray[$j].$cellRow;
                    $productOptions = $items[$i]->getProductOptions();
                    $orderID = $items[$i]->getOrderId();
                    $orderAttr = $productOptions['info_buyRequest'];

                    /*$order = $orderModel->load($orderID);$order->getCustomerName();*/

                    switch ($alphabetArray[$j]) {
                        case 'A':
                            $val = $i;
                            break;

                        case 'B':
                            $val = $orderAttr['prb_name_title'];
                            break;

                        case 'C':
                            $val = $orderAttr['prb_text_size'];
                            break;

                        case 'D':
                            $val = $orderAttr['prb_printer_text_colour'];
                            break;

                        case 'E':
                            $val = $orderAttr['prb_fonts'];
                            break;

                        case 'F':
                            $val = $orderAttr['prb_title'];
                            break;

                        case 'G':
                            $val = $orderAttr['prb_title_size'];
                            break;

                        case 'H':
                            $val = $orderAttr['prb_printer_title_colour'];
                            break;

                        case 'I':
                            $val = $orderAttr['prb_title_fonts'];
                            break;

                        case 'J':
                            $val = $orderAttr['prb_printer_back_colour'];
                            break;

                        case 'K':
                            $val = $orderAttr['prb_product_image_path'];
                            break;

                        case 'L':
                            $val = $orderAttr['prb_smiley_image_path'];
                            break;

                        case 'M':
                            $val = $baseUrl.substr($orderAttr['prb_customized_image'],1,strlen($orderAttr['prb_customized_image'])-1);
                            break;

                        case 'N':
                            $val = $baseUrl.str_replace('product_img_', 'label_img_',substr($orderAttr['prb_customized_image'],1,strlen($orderAttr['prb_customized_image'])-1));
                            break;

                        default:
                            $val = '';
                            break;
                    }

                    $sheet->setCellValue($index,$val);
                    if($alphabetArray[$j] == 'M' || $alphabetArray[$j] == 'N'){

                        $sheet->getCell($index)->getHyperlink()->setUrl($val);
                        $sheet->getCell($index)->getHyperlink()->setTooltip($val);
                    }

                }
            }


            $writer = new PHPExcel_Writer_Excel2007($workbook);
            $date = date("d_m_Y_h_i_s");

            //header('Content-type: application/vnd.ms-excel');
            $xlsName = 'Badge_Order_Printer_'.$date.'.xlsx';
            $xlsFile = 'media/export/'.$xlsName;


            $writer->save($xlsFile);
            Mage::log('Exported to xls');

            $templateId = 2;
            /*Set sender information*/
            $senderName = 'Support';// Mage::getStoreConfig('trans_email/ident_support/name');
            $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');
            $sender = array('name' => $senderName,'email' => $senderEmail);

            Mage::log('Sending Email...',null,'cronjobdetails.log');

            /*Set recepient information*/
            /*$is_allow = Mage::getStoreConfig('personalize/email/allow');

            if($is_allow == 1){ // Admin ID
                $recepientEmail = 'malin@d-sign.no';
                $recepientName  =  'Malin Berg';
            }
            else{
                $recepientEmail = trim(Mage::getStoreConfig('personalize/email/emailId'));
                if($recepientEmail == ''){
                    $recepientEmail = 'malin@d-sign.no';
                    $recepientName  =  'Malin Berg';
                }
                else{
                    $recepientName  =  'Malin Berg';
                }
            }*/


            $recepientEmail = 'ankit.dobariya@tasolglobal.com';
            $recepientName  =  'Ankit Dobariya';

            /*Get Store ID*/
            $store = Mage::app()->getStore()->getId();

            /*Set variables that can be used in email template*/
            $vars = array('subject' =>  'DEV - Printer Badge Daily Order Report 0n '.date("M d Y", mktime(0, 0, 0, date("m"),date("d"),date("Y"))));

            $translate  = Mage::getSingleton('core/translate');
            $transactionalEmail = Mage::getModel('core/email_template')->setDesignConfig(array('area'=>'frontend', 'store'=>1));

            $attachment = file_get_contents($xlsFile);

            $transactionalEmail->getMail()->createAttachment($attachment,'text/UTF-8')->filename = $xlsName;

            if($transactionalEmail->sendTransactional($templateId, $sender, $recepientEmail, "Admin", $vars)){

                $this->updateCronTable($toDate,$rowID,$write);

                Mage::log('Email Sent Successfully to '.$recepientEmail,null,'cronjobdetails.log');
            }
            else{
                Mage::log('Email Sending Failed',null,'cronjobdetails.log');
            }
        }
        if($count == 0)
        {
            Mage::log('No Records Found',null,'cronjobdetails.log');
            /*Send Mail To the Client describing that there were no orders today for the product builder*/
            $templateId = 3;
            /*Set sender information*/
            $senderName = 'Support';// Mage::getStoreConfig('trans_email/ident_support/name');
            $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');
            $sender = array('name' => $senderName,'email' => $senderEmail);

            Mage::log('Sending Email...',null,'cronjobdetails.log');
            /*Set recepient information*/
            $is_allow = Mage::getStoreConfig('personalize/email/allow');

            // if($is_allow == 1){ // Admin ID
            //     $recepientEmail = 'malin@d-sign.no';
            //     $recepientName  =  'Malin Berg';
            // }
            // else{
            //     $recepientEmail = trim(Mage::getStoreConfig('personalize/email/emailId'));
            //     if($recepientEmail == ''){
            //         $recepientEmail = 'malin@d-sign.no';
            //         $recepientName  =  'Malin Berg';
            //     }
            //     else{
            //         $recepientName  =  'Malin Berg';
            //     }
            // }

            $recepientEmail = 'ankit.dobariya@tasolglobal.com';
            $recepientName  =  'Ankit Dobariya';

            /*Get Store ID*/
            $store = Mage::app()->getStore()->getId();

            /*Set variables that can be used in email template*/
            $vars = array('subject' =>  'DEV - Printer Badge Daily Order Report 0n '.date("M d Y", mktime(0, 0, 0, date("m"),date("d"),date("Y"))));

            $translate  = Mage::getSingleton('core/translate');
            $transactionalEmail = Mage::getModel('core/email_template')->setDesignConfig(array('area'=>'frontend', 'store'=>1));

            if($transactionalEmail->sendTransactional($templateId, $sender, $recepientEmail, "Admin", $vars))
            {
                $this->updateCronTable($toDate,$rowID,$write);
                Mage::log('Email Sent Successfully to '.$recepientEmail,null,'cronjobdetails.log');
            }
            else
            {
                Mage::log('Email sending Failed',null,'cronjobdetails.log');
            }
        }

    }

    public function indexcrondaily()
    {
        Mage::log("Run Cron For Printer");
        Mage::log('::Cron Run::',null,'dailycron_april.log');
        $baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $toDate = Mage::getSingleton('core/date')->gmtDate('Y-m-d H:i:s');
        $days = 1;
        // $today = date('l');
        // if($today == 'Tuesday' || $today == 'Wednesday'){
        //     $days = 3;
        // }
        // elseif ($today == 'Friday' || $today == 'Saturday') {
        //     $days = 2;
        // }
        $fromDate = $this->date_subDate($toDate,$days,0,0,0);

        Mage::log('From: '.$fromDate,null,'dailycron_april.log');
        Mage::log('To: '.$toDate,null,'dailycron_april.log');

        // Mage::log(date('Y-m-d h:i:s'),null,'DailyExcel.log');
        // Mage::log($fromDate,null,'DailyExcel.log');
        // exit;
        // $fromDate = date('2015-01-21 07:28:40');

        /* Get the collection */
        $orders = Mage::getModel('sales/order_item')->getCollection()->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate));

        $salesModel=Mage::getModel("sales/order_item");
        $salesCollection = $salesModel->getCollection();
        $items = array();
        $inc = 1;
        foreach($orders as $order)
        {
            $orderFull = Mage::getModel('sales/order')->load($order->getOrderId());

            $orderStatus = $orderFull->getStatus();

            $attributes = $order->getProductOptions();
         if (isset($attributes['info_buyRequest']['prb_customized_image']) && $orderStatus != 'pending_payment' && $orderStatus != 'canceled')
            {
                $items[$inc] = $order;
                $inc++;
            }
            $orderId= $order->getOrderId();
        }
        $count = count($items);
        Mage::log('::count::',null,'dailycron_april.log');
        Mage::log($count,null,'dailycron_april.log');
        if ($count and $count > 0)
        {
            require_once("lib/ExcelClasses/PHPExcel.php");
            // Create an instance
            $workbook = new PHPExcel;
            $sheet = $workbook->getActiveSheet();
            $boldArray = array(
                'font' => array(
                    'bold' => true,
                    'size' => 12,
                ),
            );
            $borderArray = array(
                'borders' => array(
                    'left' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                    ),
                    'right' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                    ),
                ),
            );


            $bottomStart = $count+3;
            $bottomEnd   = $count+7;
            $sheet->getStyle('A1:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $sheet->getStyle('A1:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $sheet->getStyle('A1:I4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('A1:I4')->applyFromArray(array('font' => array('size' => 16)));

            // Footer - Start
            $sheet->setCellValue('A1','Requested by:  Vaktrommet As');
            $sheet->mergeCells('A1:F4');

            $sheet->setCellValue('G1','Date:  '.date("d-m-Y",mktime(date('h'),date('i'),date('s'),date('m'),date('d')-1,date('Y'))).'');
            $sheet->mergeCells('G1:I4');
            // Footer - End

            $sheet->getStyle('A6:N6')->applyFromArray($boldArray);
            $sheet->getStyle('A7:N7')->applyFromArray(array('font' => array('size' => 12)));

            $sheet->getColumnDimension('J')->setWidth(20);
            $sheet->getColumnDimension('M')->setWidth(20);
            $sheet->getColumnDimension('N')->setWidth(25);
            $sheet->getRowDimension('6')->setRowHeight(20);
            $sheet->getRowDimension('7')->setRowHeight(20);

            $sheet->getStyle('A6:N6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A6:N6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

            $sheet->getStyle('B6:N6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');

            $sheet->getStyle('A6:A7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('B6:E7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('B6:E6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('F6:I7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('F6:I6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('J6:J7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('J6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('K6:K7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('K6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('L6:L7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('L6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('M6:M7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('M6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->getStyle('N6:N7')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $sheet->getStyle('N6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            // //Header row 1 - Start
            $sheet->setCellValue('A6','Badge');
            $sheet->mergeCells('A6:A7');

            $sheet->setCellValue('B6','Text');
            $sheet->mergeCells('B6:E6');

            $sheet->setCellValue('F6','Title');
            $sheet->mergeCells('F6:I6');

            $sheet->setCellValue('J6','Background Color');

            $sheet->setCellValue('K6','Image');

            $sheet->setCellValue('L6','Emotion');

            $sheet->setCellValue('M6','Preview Image');

            $sheet->setCellValue('N6','High Resolution Image');
            // //Header row 1 - End

            // //Header row 2 - Start
            $sheet->setCellValue('B7','Name');

            $sheet->setCellValue('C7','Font-Size');

            $sheet->setCellValue('D7','Color');

            $sheet->setCellValue('E7','Font-Style');

            $sheet->setCellValue('F7','Name');

            $sheet->setCellValue('G7','Font-Size');

            $sheet->setCellValue('H7','Color');

            $sheet->setCellValue('I7','Font-Style');

            $sheet->setCellValue('J7','Color');

            $sheet->setCellValue('K7','');

            $sheet->setCellValue('L7','');

            $sheet->setCellValue('M7','');

            // //Header row 2 - End

            // //Record View - Start
            $alphabetArray = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N");
            $orderModel = Mage::getModel('sales/order');
            Mage::log("Sales Items Presrnt for Print");


            for($i=1;$i<=$count;$i++) {
                for($j=0;$j<count($alphabetArray);$j++) {
                    $cellRow = $i+7;
                    $index = $alphabetArray[$j].$cellRow;
                    $productOptions = $items[$i]->getProductOptions();
                    $orderID = $items[$i]->getOrderId();
                    $orderAttr = $productOptions['info_buyRequest'];

                    /*$order = $orderModel->load($orderID);$order->getCustomerName();*/

                    switch ($alphabetArray[$j]) {
                        case 'A':
                            $val = $i;
                            break;

                        case 'B':
                            $val = $orderAttr['prb_name_title'];
                            break;

                        case 'C':
                            $val = $orderAttr['prb_text_size'];
                            break;

                        case 'D':
                            $val = $orderAttr['prb_printer_text_colour'];
                            break;

                        case 'E':
                            $val = $orderAttr['prb_fonts'];
                            break;

                        case 'F':
                            $val = $orderAttr['prb_title'];
                            break;

                        case 'G':
                            $val = $orderAttr['prb_title_size'];
                            break;

                        case 'H':
                            $val = $orderAttr['prb_printer_title_colour'];
                            break;

                        case 'I':
                            $val = $orderAttr['prb_title_fonts'];
                            break;

                        case 'J':
                            $val = $orderAttr['prb_printer_back_colour'];
                            break;

                        case 'K':
                            $val = $orderAttr['prb_product_image_path'];
                            break;

                        case 'L':
                            $val = $orderAttr['prb_smiley_image_path'];
                            break;

                        case 'M':
                            $val = $baseUrl.substr($orderAttr['prb_customized_image'],1,strlen($orderAttr['prb_customized_image'])-1);
                            break;

                        case 'N':
                            $val = $baseUrl.str_replace('product_img_', 'label_img_',substr($orderAttr['prb_customized_image'],1,strlen($orderAttr['prb_customized_image'])-1));
                            break;

                        default:
                            $val = '';
                            break;
                    }

                    $sheet->setCellValue($index,$val);

                }
            }


            $writer = new PHPExcel_Writer_Excel2007($workbook);
            $date = date("d_m_Y_h_i_s");

            //header('Content-type: application/vnd.ms-excel');
            $xlsName = 'Badge_Order_Printer_'.$date.'.xlsx';
            $xlsFile = 'media/export/'.$xlsName;


            $writer->save($xlsFile);
            Mage::log('Exported to xls');

            $templateId = 2;
            /*Set sender information*/
            $senderName = 'Support';// Mage::getStoreConfig('trans_email/ident_support/name');
            $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');
            $sender = array('name' => $senderName,'email' => $senderEmail);

            Mage::log('Sending Email',null,'dailycron_april.log');

            /*Set recepient information*/
            $is_allow = Mage::getStoreConfig('personalize/email/allow');

            // if($is_allow == 1){ // Admin ID
            //     $recepientEmail = 'malin@d-sign.no';
            //     $recepientName  =  'Malin Berg';
            // }
            // else{
            //     $recepientEmail = trim(Mage::getStoreConfig('personalize/email/emailId'));
            //     if($recepientEmail == ''){
            //         $recepientEmail = 'malin@d-sign.no';
            //         $recepientName  =  'Malin Berg';
            //     }
            //     else{
            //         $recepientName  =  'Malin Berg';
            //     }
            // }

            $recepientEmail = 'ankit.dobariya@tasolglobal.com';
            $recepientName  =  'Ankit Dobariya';


            /*Get Store ID*/
            $store = Mage::app()->getStore()->getId();

            /*Set variables that can be used in email template*/
            $vars = array('subject' =>  'DEV - Printer Badge Daily Order Report 0n '.date("M d Y", mktime(0, 0, 0, date("m"),date("d"),date("Y"))));

            $translate  = Mage::getSingleton('core/translate');
            $transactionalEmail = Mage::getModel('core/email_template')->setDesignConfig(array('area'=>'frontend', 'store'=>1));

            $attachment = file_get_contents($xlsFile);

            $transactionalEmail->getMail()->createAttachment($attachment,'text/UTF-8')->filename = $xlsName;
            if($transactionalEmail->sendTransactional($templateId, $sender, $recepientEmail, "Admin", $vars))
            {
                Mage::log('Email Sent Successfully to'.$recepientEmail,null,'dailycron_april.log');
            }
            else
            {
                Mage::log('Email Sending Failed',null,'dailycron_april.log');
            }
        }
        if($count == 0)
        {
            Mage::log('No Record Found',null,'dailycron_april.log');
            /*Send Mail To the Client describing that there were no orders today for the product builder*/
            $templateId = 3;
            /*Set sender information*/
            $senderName = 'Support';// Mage::getStoreConfig('trans_email/ident_support/name');
            $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');
            $sender = array('name' => $senderName,'email' => $senderEmail);

            Mage::log('Email sending with zero records',null,'dailycron_april.log');
            /*Set recepient information*/
            $is_allow = Mage::getStoreConfig('personalize/email/allow');

            // if($is_allow == 1){ // Admin ID
            //     $recepientEmail = 'malin@d-sign.no';
            //     $recepientName  =  'Malin Berg';
            // }
            // else{
            //     $recepientEmail = trim(Mage::getStoreConfig('personalize/email/emailId'));
            //     if($recepientEmail == ''){
            //         $recepientEmail = 'malin@d-sign.no';
            //         $recepientName  =  'Malin Berg';
            //     }
            //     else{
            //         $recepientName  =  'Malin Berg';
            //     }
            // }

            $recepientEmail = 'ankit.dobariya@tasolglobal.com';
            $recepientName  =  'Ankit Dobariya';


            /*Get Store ID*/
            $store = Mage::app()->getStore()->getId();

            /*Set variables that can be used in email template*/
            $vars = array('subject' =>  'DEV - Printer Badge Daily Order Report 0n '.date("M d Y", mktime(0, 0, 0, date("m"),date("d"),date("Y"))));

            $translate  = Mage::getSingleton('core/translate');
            $transactionalEmail = Mage::getModel('core/email_template')->setDesignConfig(array('area'=>'frontend', 'store'=>1));

            if($transactionalEmail->sendTransactional($templateId, $sender, $recepientEmail, "Admin", $vars))
            {
                Mage::log('Email Sent Successfully to'.$recepientEmail,null,'dailycron_april.log');
                Mage::log('Sent mail');
            }
            else
            {
                Mage::log("Sent n mail ",null,'dailycron_april.log');
                Mage::log('Mail Failed');
            }
        }

    }

    // public function date_subDate($text, $da=0, $ma=0, $ya=0, $ha=0)
    // {
    //     $h=date('H',strtotime($text));
    //     $d=date('d',strtotime($text));
    //     $m=date('m',strtotime($text));
    //     $y=date('Y',strtotime($text));
    //     $fromTime =date("Y-m-d 00:00:00", mktime($h-$ha, 0, 0, $m-$ma, $d-$da, $y-$ya));
    //     return $fromTime;
    // }

    public function date_subDate($text, $da=0, $ma=0, $ya=0, $ha=0)
    {
        $h=date('H',strtotime($text));
        $i=date('i',strtotime($text));
        $s=date('s',strtotime($text));
        $d=date('d',strtotime($text));
        $m=date('m',strtotime($text));
        $y=date('Y',strtotime($text));

        $fromTime =date("Y-m-d H:i:s", mktime($h-$ha, $i, $s, $m-$ma, $d-$da, $y-$ya));
        return $fromTime;
    }

    function updateCronTable($lastrun,$rowID,$write){

        $data  = array("lastrun" => $lastrun);
        $where = "id = 1";
        $write->update("cron_job_table", $data, $where);
    }

    public function versioncontrol()
    {
        $fh = fopen('/var/www/html/vaktrommet_dev/var/log/version.log', 'a+' );
        fclose($fh);
        $browser = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
        $order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());
        Mage::log('Order No: '.$order->getIncrementId().' '.$browser, null, 'version.log');
    }
    /*public function svghighressoutiondivcode()
    {
        $product_highres_svg =$post_data['product_highres_svg'];
        $productLabelImageSvgStr=$post_data['productLabelImageSvgStr'];
        $product_highres_svg_and_productLabelImageSvgStr= $product_highres_svg."<br>".$productLabelImageSvgStr;
        Mage::log($product_highres_svg_and_productLabelImageSvgStr,null,'svghighresdiv.log');
        Mage::log('fdfjsgjg',null,'svghighresdiv.log');


    }*/
}
?>

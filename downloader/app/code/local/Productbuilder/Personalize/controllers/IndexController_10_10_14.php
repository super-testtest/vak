<?php 
/*
 * Controller class has to be inherited from Mage_Core_Controller_action
 */
class Productbuilder_Personalize_IndexController extends Mage_Core_Controller_Front_Action//Varien_Object
{
 
    /*
     * Provides default action.
     * Loads the personaliazed product
     */
    public function indexAction()
    {
        /*
         * Initialization of Mage_Core_Model_Layout model
         */
        $product = $this->getRequest()->getParam('product');
        $qty     = $this->getRequest()->getParam('qty');
        $_product = Mage::getModel('catalog/product')->load($product);

        /*Check Item Stock*/
		$qtyStock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product);
        $qty = $qtyStock->getQty();
        $minQty = $qtyStock->getMinSaleQty();
        $qtyCheck = ($qty > $minQty) ? 1 : 0 ;

        /*Check Product's Status*/
        $status = $_product->getStatus();

        Mage::register('product', $_product);
        
        if ($product !== '' and $qtyCheck == 1 and $status == 1)
        {
          $personalizeProduct = Mage::getModel("Productbuilder_Personalize/Personalize");
          $qty = $qty ? $qty : 1;
       		$attributesData = $personalizeProduct->getAttributes($product , $qty);
       		$clipArtFolderList = $personalizeProduct->getClipArtFolderList();
   		    $attributes = Mage::getSingleton('Productbuilder_Personalize/Personalize');
    		  $attributes->setData('attributesData', $attributesData);
    		  $attributes->setData('clipArtFolderList', $clipArtFolderList);
        }

        else
        {
            Mage::getSingleton("core/session")->addError("Product is not available for customization");
            $url = Mage::getUrl('checkout/cart');
			Mage::app()->getFrontController()->getResponse()->setRedirect($url);
            session_write_close();
			//$this->_redirect('checkout/cart');
        }
        /*
         * Building page according to layout confuration
         */
        $this->loadLayout();
        $this->renderLayout();
    }

    public function createCustomImageAction()
    {
        $post_data = $this->getRequest()->getParams();

        $var = time();
        $filePath = '/media/catalog/product/productbuilder/product_img_'.$var.'.png';
        $file_name = getcwd().$filePath;

        $fh = fopen($file_name, 'w') or die("can't open file");
        $image = explode('base64,',$post_data['png_data1']); 
        fwrite($fh, base64_decode($image[1]));
        fclose($fh);
        
        $session = Mage::getSingleton('checkout/session');
        $session->setCustomImage($filePath);

        if($post_data['cartEditMode'] && $post_data['cartEditMode'] == 1)
        {
        	if($post_data['cartEditId'] && $post_data['cartEditId'] != 0)
        	{
        		$remove_previous_product  = Mage::getSingleton('checkout/cart')->removeItem($post_data['cartEditId'])->save();
        	}
        }
        echo $session->getCustomImage();
    }
    
	public function indexcronAction()
    {
		/*echo Mage::getModel('core/date')->date('Y-m-d H:i:s');
		echo "To : ".$toDate   = date('Y-m-d H:i:s', Mage::getModel('core/date')->timestamp(time()));
		echo "<br />"."From : ".$fromDate = $this->date_subDate($toDate,1,0,0,0);*/
		Mage::getModel('core/date')->date('Y-m-d H:i:s');
    	$baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
    	echo $toDate = Mage::getSingleton('core/date')->gmtDate('Y-m-d H:i:s');
		echo $fromDate = $this->date_subDate($toDate,1,0,0,0);

		/* Get the collection */
		$orders = Mage::getModel('sales/order_item')->getCollection()->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate));

    	$salesModel=Mage::getModel("sales/order_item");
		$salesCollection = $salesModel->getCollection();
		$items = array();
		$inc = 1;
		foreach($orders as $order)
		{
			$attributes = $order->getProductOptions();
			if (isset($attributes['info_buyRequest']['prb_customized_image']))
			{
				$items[$inc] = $order;
			    $inc++;
			}
		    $orderId= $order->getOrderId();
		}

		$count = count($items);

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

			$sheet->getStyle('A1:M1')->applyFromArray($boldArray);
			$sheet->getStyle('A2:M2')->applyFromArray(array('font' => array('size' => 12)));

			$sheet->getColumnDimension('J')->setWidth(20);
			$sheet->getColumnDimension('M')->setWidth(20);
			$sheet->getRowDimension('1')->setRowHeight(20);
			$sheet->getRowDimension('2')->setRowHeight(20);

			$sheet->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('A1:M1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

			$sheet->getStyle('B1:M1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
			
			$sheet->getStyle('A1:A2')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle('B1:E2')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle('B1:E1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			$sheet->getStyle('F1:I2')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle('F1:I1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			$sheet->getStyle('J1:J2')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle('J1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			$sheet->getStyle('K1:K2')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle('K1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			$sheet->getStyle('L1:L2')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle('L1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			$sheet->getStyle('M1:M2')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle('M1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			//Header row 1 - Start
			$sheet->setCellValue('A1','Badge');
			$sheet->mergeCells('A1:A2');
			
			$sheet->setCellValue('B1','Text');
			$sheet->mergeCells('B1:E1');
			
			$sheet->setCellValue('F1','Title');
			$sheet->mergeCells('F1:I1');
			
			$sheet->setCellValue('J1','Background Color');
			
			$sheet->setCellValue('K1','Image');
			
			$sheet->setCellValue('L1','Emotion');
			
			$sheet->setCellValue('M1','Preview Image');		
			//Header row 1 - End
			
			//Header row 2 - Start		
			$sheet->setCellValue('B2','Name');
			
			$sheet->setCellValue('C2','Font-Size');
			
			$sheet->setCellValue('D2','Color');
			
			$sheet->setCellValue('E2','Font-Style');
			
			$sheet->setCellValue('F2','Name');
			
			$sheet->setCellValue('G2','Font-Size');
			
			$sheet->setCellValue('H2','Color');
			
			$sheet->setCellValue('I2','Font-Style');

			$sheet->setCellValue('J2','Color');
			
			$sheet->setCellValue('K2','');
			
			$sheet->setCellValue('L2','');
			
			$sheet->setCellValue('M2','');
			
			//Header row 2 - End
			
			//Record View - Start
			$alphabetArray = array("A","B","C","D","E","F","G","H","I","J","K","L","M");
			$orderModel = Mage::getModel('sales/order');

			for($i=1;$i<=$count;$i++) {
				for($j=0;$j<count($alphabetArray);$j++) {
					$cellRow = $i+2;
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
						
						default:
							$val = '';
							break;
					}
					
					$sheet->setCellValue($index,$val);

				}
			}
			//Record View - End
			$bottomStart = $count+3;
			$bottomEnd	 = $count+7;
			$sheet->getStyle('A'.$bottomStart.':I'.$bottomEnd)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle('A'.$bottomStart.':I'.$bottomEnd)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);				
			$sheet->getStyle('A'.$bottomStart.':I'.$bottomEnd)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$sheet->getStyle('A'.$bottomStart.':I'.$bottomEnd)->applyFromArray(array('font' => array('size' => 16)));

			//Footer - Start		
			$sheet->setCellValue('A'.$bottomStart,'Requested by:  Vaktrommet As');
			$sheet->mergeCells('A'.$bottomStart.':F'.$bottomEnd);
			
			$sheet->setCellValue('G'.$bottomStart,'Date:  '.date("d-m-Y",mktime(date('h'),date('i'),date('s'),date('m'),date('d')-1,date('Y'))).'');
			$sheet->mergeCells('G'.$bottomStart.':I'.$bottomEnd);
			//Footer - End		
			
			$writer = new PHPExcel_Writer_Excel5($workbook);
			$date = date("d_m_Y_h_i_s");

			//header('Content-type: application/vnd.ms-excel');
			$xlsName = 'Badge_Order_Printer_'.$date.'.xls';
			$xlsFile = 'media/export/'.$xlsName;


			$writer->save($xlsFile);
			echo 'Exported to xls';
			
			$templateId = 2;
			  /*Set sender information*/
			  $senderName = 'Support';// Mage::getStoreConfig('trans_email/ident_support/name');
			  $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');
			  $sender = array('name' => $senderName,
			                'email' => $senderEmail);
			 
			  /*Set recepient information*/
			  $recepientEmail = (Mage::getStoreConfig('personalize/email/allow')) ? Mage::getStoreConfig('trans_email/ident_general/email') : (Mage::getStoreConfig('personalize/email/emailId')) ? Mage::getStoreConfig('personalize/email/emailId') : Mage::getStoreConfig('trans_email/ident_general/email');
			  $recepientName  =  'Admin';     
			 
			  /*Get Store ID*/
			  $store = Mage::app()->getStore()->getId();
			 
			  /*Set variables that can be used in email template*/
			  $vars = array('subject' =>  'Printer Badge Daily Order Report for '.date("M d Y", mktime(0, 0, 0, date("m"),date("d")-1,date("Y"))));
			  
			  $translate  = Mage::getSingleton('core/translate');
			  $transactionalEmail = Mage::getModel('core/email_template')->setDesignConfig(array('area'=>'frontend', 'store'=>1));

    		  $attachment = file_get_contents($xlsFile);

			  $transactionalEmail->getMail()->createAttachment($attachment,'text/UTF-8')->filename = $xlsName;
			  if($transactionalEmail->sendTransactional($templateId, $sender, $recepientEmail, "Admin", $vars))
			  {
			  	echo ' and sent mail';
			  	exit;
			  }
			  else
			  {
			  	echo ' but mail not sent';
			  	exit;
			  }
		}
		if($count == 0)
		{
			/*Send Mail To the Client describing that there were no orders today for the product builder*/
			$templateId = 3;
			  /*Set sender information*/
			  $senderName = 'Support';// Mage::getStoreConfig('trans_email/ident_support/name');
			  $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');
			  $sender = array('name' => $senderName,
			                'email' => $senderEmail);
			 
			  /*Set recepient information*/
			  $recepientEmail = (Mage::getStoreConfig('personalize/email/allow')) ? Mage::getStoreConfig('trans_email/ident_general/email') : (Mage::getStoreConfig('personalize/email/emailId')) ? Mage::getStoreConfig('personalize/email/emailId') : Mage::getStoreConfig('trans_email/ident_general/email');
			  $recepientName  =  'Admin';     
			 
			  /*Get Store ID*/
			  $store = Mage::app()->getStore()->getId();
			 
			  /*Set variables that can be used in email template*/
			  $vars = array('subject' =>  'Printer Badge Daily Order Report 0n '.date("M d Y", mktime(0, 0, 0, date("m"),date("d"),date("Y"))));
			  
			  $translate  = Mage::getSingleton('core/translate');
			  $transactionalEmail = Mage::getModel('core/email_template')->setDesignConfig(array('area'=>'frontend', 'store'=>1));

			  if($transactionalEmail->sendTransactional($templateId, $sender, $recepientEmail, "Admin", $vars))
			  {
			  	echo ' sent mail';
			  	exit;
			  }
			  else
			  {
			  	echo ' mail not sent';
			  	exit;
			  }
		}

    }

	public function date_subDate($text, $da=0, $ma=0, $ya=0, $ha=0)
	{
		$h=date('H',strtotime($text));
		$d=date('d',strtotime($text));
		$m=date('m',strtotime($text));
		$y=date('Y',strtotime($text));
		$fromTime =date("Y-m-d H:i:s", mktime($h-$ha, 0, 0, $m-$ma, $d-$da, $y-$ya));
		return $fromTime;
	}

  public function processuploadAction()
  {
	if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
	{
		$UploadDirectory	= getcwd().'/js/PHP/Samples_ImageUploaderFlashPHP/UploadedFiles/';
				
		//check if this is an ajax request
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			die();
		}
		
		
		//Is file size is less than allowed size.
		if ($_FILES["FileInput"]["size"] > 5242880) {
			die("File size is too big!");
		}
		
		//allowed file type Server side check
		switch(strtolower($_FILES['FileInput']['type']))
			{
				//allowed file types
	            case 'image/png': 
				case 'image/gif': 
				case 'image/jpeg': 
				case 'image/pjpeg':
					break;
				default:
					die('Unsupported File!');
		}
		
		$File_Name          = strtolower($_FILES['FileInput']['name']);
		$File_Ext           = substr($File_Name, strrpos($File_Name, '.'));
		$Random_Number      = rand(0, 9999999999);
		$NewFileName 		= $Random_Number.'_'.$File_Name;
		
		if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
		{
			die($NewFileName);
		}
		else
		{
			die('Error Uploading File!');
		}
		
	}
	else
	{
		die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
	}
  }

}
?>
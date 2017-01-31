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
        Mage::register('product', $_product);
        
        if ($product and $product !== '')
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
            Mage::getSingleton("core/session")->addError("Please Select Your Product To Customize");
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
/*		require_once("lib/ExcelClasses/PHPExcel.php");
		// Create an instance
		$workbook = new PHPExcel;
		$sheet = $workbook->getActiveSheet();
		$sheet->getStyle('A1:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A1:K2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		
		$sheet->getStyle('A1:K1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$sheet->getStyle('A1:A2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$sheet->getStyle('A2:K2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$sheet->getStyle('K1:K2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		
		$sheet->getStyle('A13:I18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$sheet->getStyle('A13:I18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		
		$sheet->getStyle('A13:I13')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$sheet->getStyle('A13:A18')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$sheet->getStyle('A18:I18')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$sheet->getStyle('I13:I18')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		
		$sheet->getStyle('A14:I14')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet->getStyle('A16:I16')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		
		//Header row 1 - Start
		$sheet->setCellValue('A1','Badge:');
		$sheet->mergeCells('A1:A2');
		
		$sheet->setCellValue('B1','Badge type:');
		$sheet->mergeCells('B1:C1');
		
		$sheet->setCellValue('D1','Badge attachment:');
		$sheet->mergeCells('D1:E1');
		
		$sheet->setCellValue('F1','Badge colour:');
		$sheet->mergeCells('F1:H1');
		
		$sheet->setCellValue('I1','Name as displayed on badge');
		
		$sheet->setCellValue('J1','Title');
		
		$sheet->setCellValue('K1','School/Faculty');		
		//Header row 1 - End
		
		//Header row 2 - Start		
		$sheet->setCellValue('B2','Dome');
		
		$sheet->setCellValue('C2','Flat');
		
		$sheet->setCellValue('D2','Clip');
		
		$sheet->setCellValue('E2','Magnet');
		
		$sheet->setCellValue('F2','Cyan');
		
		$sheet->setCellValue('G2','Lime Green');
		
		$sheet->setCellValue('H2','Orange');		
		//Header row 2 - End
		
		//Record View - Start
		$alphabetArray = array("A","B","C","D","E","F","G","H","I","J","K");
		for($i=0;$i<10;$i++) {
			for($j=0;$j<count($alphabetArray);$j++) {
				$cellRow = $i+3;
				$index = $alphabetArray[$j].$cellRow;
				
				$val = "Record :".$i;
				
				$sheet->setCellValue($index,$val);
			}
		}
		//Record View - End
		
		//Footer - Start		
		$sheet->setCellValue('A13','Requested by:  Edgar Maynard');
		$sheet->mergeCells('A13:F14');
		
		$sheet->setCellValue('G13','Date:  20/01/2014');
		$sheet->mergeCells('G13:I14');
		
		$sheet->setCellValue('A15','Faculty/Department:  ENT');
		$sheet->mergeCells('A15:F16');
		
		$sheet->setCellValue('G15','Ext.: 5103');
		$sheet->mergeCells('G15:I16');
		
		$sheet->setCellValue('A17','Budget code:  11.100780.3660');
		$sheet->mergeCells('A17:F18');
		
		$sheet->setCellValue('G17','Budget holder:  Edgar Maynard');
		$sheet->mergeCells('G17:I18');		
		//Footer - End		
		
		$writer = new PHPExcel_Writer_Excel5($workbook);
		$date = date("d_m_Y_h_i_s");
		//header('Content-type: application/vnd.ms-excel');
		$writer->save('media/export/'.$date.'.xlsx');
		echo 'Exported to xls';
		exit; 
*/		/*$salesModel=Mage::getModel("sales/order_item");
		$salesCollection = $salesModel->getCollection();
		foreach($salesCollection as $order)
		{
			echo "<pre />";print_r($order);
			$attributesArray = $_item->getProductOptions();
		    $orderId= $order->getIncrementId();
		    echo $orderId;
		}*/
    }
}
?>
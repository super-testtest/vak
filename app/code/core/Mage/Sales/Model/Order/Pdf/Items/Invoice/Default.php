<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Sales
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Sales Order Invoice Pdf default items renderer
 *
 * @category   Mage
 * @package    Mage_Sales
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Mage_Sales_Model_Order_Pdf_Items_Invoice_Default extends Mage_Sales_Model_Order_Pdf_Items_Abstract
{
    /**
     * Draw item line
     */
    public function draw()
    {
        $order  = $this->getOrder();
        $item   = $this->getItem();
        $pdf    = $this->getPdf();
        $page   = $this->getPage();
        $lines  = array();


        // draw Product name
        $lines[0] = array(array(
            'text' => Mage::helper('core/string')->str_split($item->getName(), 35, true, true),
            'feed' => 35,
        ));

        // draw SKU
        $lines[0][] = array(
            'text'  => Mage::helper('core/string')->str_split($this->getSku($item), 17),
            'feed'  => 290,
            'align' => 'right'
        );

        // draw QTY
        $lines[0][] = array(
            'text'  => $item->getQty() * 1,
            'feed'  => 435,
            'align' => 'right'
        );

        // draw item Prices
        $i = 0;
        $prices = $this->getItemPricesForDisplay();
        $feedPrice = 395;
        $feedSubtotal = $feedPrice + 170;
        foreach ($prices as $priceData){
            if (isset($priceData['label'])) {
                // draw Price label
                $lines[$i][] = array(
                    'text'  => $priceData['label'],
                    'feed'  => $feedPrice,
                    'align' => 'right'
                );
                // draw Subtotal label
                $lines[$i][] = array(
                    'text'  => $priceData['label'],
                    'feed'  => $feedSubtotal,
                    'align' => 'right'
                );
                $i++;
            }
            // draw Price
            $lines[$i][] = array(
                'text'  => $priceData['price'],
                'feed'  => $feedPrice,
                'font'  => 'bold',
                'align' => 'right'
            );
            // draw Subtotal
            $lines[$i][] = array(
                'text'  => $priceData['subtotal'],
                'feed'  => $feedSubtotal,
                'font'  => 'bold',
                'align' => 'right'
            );
            $i++;
        }

        // draw Tax
        $lines[0][] = array(
            'text'  => $order->formatPriceTxt($item->getTaxAmount()),
            'feed'  => 495,
            'font'  => 'bold',
            'align' => 'right'
        );

        $customOptionId = '';
        $productType = '';

        if($item->getProduct()){
            $_product = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
            $productType = $_product->getTypeId();
            
            if($productType == 'customproduct'){
                $image_price = '';
                $image_price_currency = '';
                
                $_taxHelper  = new Mage_Tax_Helper_Data;
                $CustomOptions = $_product->getOptions();
                $optionsAvail = count($CustomOptions);

                if ($optionsAvail && $optionsAvail == 1){
                    foreach($CustomOptions as $optionKey => $optionVal)
                    {

                        foreach($optionVal->getValues() as $valuesKey => $valuesVal)
                        {
                            $optionPrice            = $valuesVal->getPrice(); // -208
                            if($valuesVal->getSku() == Mage::helper('personalize')->getImageSku()){
                                $main_img_price         = $_taxHelper->getPrice($_product,$optionPrice,true);
                                $image_price            = $_taxHelper->getPrice($_product,$optionPrice,true);
                                $image_price_currency   = Mage::helper('core')->currency($image_price, true, false);
                                $image_price            = Mage::helper('core')->currency($image_price, false, false);
                                $imageOptionTypeId      = $valuesVal->getOptionTypeId();
                                $customOptionId         = $valuesVal->getOptionId();
                                // echo '<pre>';print_r($customOptionId);exit;
                            }
                        }
                    }
                }
            }
        }

        
        if($item->getProduct()){
            $_product = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
            $replace1 = array("prb_","_");
            $replace2 = array(""," ");
            $attributesArray = $item->getProductOptions();
            Mage::log($attributesArray,null,'pdfAttachement.log');
            $excludeArray = array(
                    'prb_img_x1',
                    'prb_img_x2',
                    'prb_img_y1',
                    'prb_img_y2',
                    'prb_customized_image',
                    'prb_printer_back_colour',
                    'prb_printer_title_colour',
                    'prb_printer_text_colour',
                    'prb_fa_text',
                    'prb_printer_extratext_colour',
                    'prb_printer_fa_colour',
                    'prb_fonts',
                    'prb_text_size',
                    'prb_title_size',
                    'prb_title_fonts',
                    'prb_fa_size',
                    'prb_extra_field',
                    'prb_extra_font',
                    'prb_extra_size',
                );

            foreach($attributesArray['info_buyRequest'] as $key=>$val) {
                if (strpos($key,'prb_') !== false && $val != '') {
                
                    Mage::log($key.' '.$val,null,'pdfAttachement.log');
                    if(filter_var($val, FILTER_VALIDATE_URL)){ 
                        $path = parse_url($val, PHP_URL_PATH);
                        $a    = explode('/' , $path);
                        $img  = $a[count($a)-1];
                        $ext  = pathinfo($img, PATHINFO_EXTENSION);
                        if (in_array($ext, array('svg','jpg','jpeg','png'))){
                                    
                        }
                    }
                    else{
                        if (!in_array($key, $excludeArray)){
                            $key = str_replace($replace1,$replace2,$key);
                            $key = str_replace('tweezer', 'Forceps', $key);
                            $lines[][] = array(
                                'font' => 'italic',
                                'text' => $key.': '.$val,
                                'feed' => 40
                            );
                        }
                    }
                }
            }
        }
        // custom options
        $options = $this->getItemOptions();
        if ($options) {
            foreach ($options as $option) {
                // draw options label
                $lines[][] = array(
                    'text' => Mage::helper('core/string')->str_split(strip_tags($option['label']), 40, true, true),
                    'font' => 'italic',
                    'feed' => 35
                );

                if ($option['value']) {
                    if (isset($option['print_value'])) {
                        $_printValue = $option['print_value'];
                    } else {
                        $_printValue = strip_tags($option['value']);
                    }
                    $values = explode(', ', $_printValue);
                    foreach ($values as $value) {
                        $lines[][] = array(
                            'text' => Mage::helper('core/string')->str_split($value, 30, true, true),
                            'feed' => 40
                        );
                    }

                    if($option['option_id'] == $customOptionId && $productType == 'customproduct'){
                        $value_array = explode(',', $option['value']);
                        $value_cnt = count($value_array);
                        $total_price_w_c = $main_img_price * $value_cnt;
                        $total_price   = Mage::helper('core')->currency($total_price_w_c, true, false);

                        $custom_price = ' - '.$image_price_currency.' x '.$value_cnt.' = '.$total_price;
                        $lines[][] = array(
                            'font' => 'italic',
                            'text' => Mage::helper('core/string')->str_split($custom_price, 30, true, true),
                            'feed' => 40
                        );
                    }
                }
            }
        }
        
        Mage::log($lines,null,'pdfAttachement.log');
        $lineBlock = array(
            'lines'  => $lines,
            'height' => 20
        );

        $page = $pdf->drawLineBlocks($page, array($lineBlock), array('table_header' => true));
        $this->setPage($page);
    }
}

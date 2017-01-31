<?php
class Productbuilder_Personalize_Model_Personalize extends Varien_object//Mage_Core_Model_Abstract
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAttributes($product , $qty)
    {
    	$id = $product;
		$_product = Mage::getModel('catalog/product')->load($id);
		$entiryTypeId = $_product->getEntity_type_id();
		$attributSetId = $_product->getAttribute_set_id();

    	$resource = Mage::getSingleton('core/resource');

    	//Get product attribute set id and get all attributes from that START
	    $readConnection = $resource->getConnection('core_read');
	    $table = $resource->getTableName('eav/attribute');
	    /*echo 'SELECT * FROM ' . $table .' WHERE
	    									attribute_id in (SELECT attribute_id FROM eav_entity_attribute WHERE
											entity_type_id = '.$entiryTypeId.'
	    										AND attribute_set_id = '.$attributSetId.')
	    									AND attribute_code LIKE "prb_%"
	    									AND attribute_code != "prb_is_personalized"';*/
	    									
	    $productData = $readConnection->fetchAll('SELECT * FROM ' . $table .' WHERE
	    									attribute_id in (SELECT attribute_id FROM eav_entity_attribute WHERE
											entity_type_id = '.$entiryTypeId.'
	    										AND attribute_set_id = '.$attributSetId.')
	    									AND attribute_code LIKE "prb_%"
	    									AND attribute_code != "prb_is_personalized"');

	    //Get product attribute set id and get all attributes from that END
    	return $productData;
    }

    public function getAttributeData($attribute_id,$attribute_code,$frontend_label,$frontend_input,$default_value='',$frontend_class='',$store_id)
    {
    	$helper = Mage::helper('personalize');
    	$resource = Mage::getSingleton('core/resource');
	    $readConnection = $resource->getConnection('core_read');
	    //if($frontend_class != '')
		$class = ' class="'.$attribute_code.' '.$frontend_class.'"';
		//else
			//$class = '';
	    $html['lable'] = $frontend_label;
	    $html['data'] = '';
    	switch($frontend_input) {
    		case 'select':
			$table = $resource->getTableName('eav/attribute_option_value');
			$selectOptionDataEng = $readConnection->fetchAll('
					  SELECT eaov.* , eao.* FROM ' . $table .' eaov
					  LEFT JOIN eav_attribute_option eao
					  ON eaov.option_id = eao.option_id
					  WHERE eao.attribute_id = '.$attribute_id.' AND eaov.store_id = 1
					  ORDER BY eao.sort_order ASC ');


			$selectOptionData = $readConnection->fetchAll('
					  SELECT eaov.* , eao.* FROM ' . $table .' eaov
					  LEFT JOIN eav_attribute_option eao
					  ON eaov.option_id = eao.option_id
					  WHERE eao.attribute_id = '.$attribute_id.' AND eaov.store_id = '.$store_id.'
					  ORDER BY eao.sort_order ASC ');

    		if (!in_array($attribute_code, array("prb_fonts","prb_title_fonts","prb_extra_font")) )
    		{

  				if(in_array($attribute_code, array("prb_text_size","prb_title_size","prb_fa_size","prb_extra_size")))
					$selectOptionData = $this->usortArray($selectOptionData);

				$html['data'] .= '<select name="'.$attribute_code.'" '.$class.'>';
				if(empty($default_value))
					$html['data'] .= '<option value=""></option>';

				foreach($selectOptionData as $selectOption) {
					if($selectOption['option_id'] == $default_value)
						$selected = 'selected="selected"';
					else
						$selected = '';

					$html['data'] .= '<option value="'.$selectOption['value'].'" '.$selected.'>'.$selectOption['value'].'</option>';
				}
				$html['data'] .= "</select>";
    		}
    		else
    		{

    			$html['data'] .= '<div id="div_'.$attribute_code.'"><select name="'.$attribute_code.'" '.$class.'>';
				if(empty($default_value))
					$html['data'] .= '<option value=""></option>';
				$i = 0;
				foreach($selectOptionData as $selectOption) {
					if($selectOption['option_id'] == $default_value)
						$selected = 'selected="selected"';
					else
						$selected = '';

					$html['data'] .= '<option data-description="'.$selectOptionDataEng[$i]['value'].';" value="'.$selectOption['value'].'" '.$selected.'>'.$selectOption['value'].'</option>';
					$i++;
				}
				$html['data'] .= "</select></div>";

    			/*if ($attribute_code == "prb_fonts"){
    				$text = $helper->__('Your Text');
    			}
				if ($attribute_code == "prb_title_fonts"){
	   				$text = $helper->__('Your Title');
				}
				if ($attribute_code == "prb_extra_font"){
	   				$text = $helper->__('Your Text');
				}

				$html['data'] .= '<div '.$class.'>';

				$i = 0;
				foreach($selectOptionData as $selectOption)
				{
	    			if ($attribute_code == "prb_fonts"){
	    				$onclick = 'onclick = "changeText(this.rel,\''.$selectOption['value'].'\')"';
	    			}
					if ($attribute_code == "prb_title_fonts"){
	    				$onclick = 'onclick = "changeTitle(this.rel,\''.$selectOption['value'].'\')"';
					}
					if ($attribute_code == "prb_extra_font"){
	    				$onclick = 'onclick = "changeExtra(this.rel,\''.$selectOption['value'].'\')"';
					}

					if($selectOption['option_id'] == $default_value)
						$h1class = 'h1selected';
					else
						$h1class = '';

					$html['data'] .= '<h4><a title="'.$selectOption['value'].'" href="javascript:void(0);" '.$onclick.' '.$h1class.'style="text-decoration:none; font-family: '.$selectOptionDataEng[$i]['value'].';" rel="'.$selectOptionDataEng[$i]['value'].'">'.$text.'</a></h4>';
					$i++;
				}
				$html['data'] .= "</div>";*/
    		}
			break;
    		case 'colorpicker' :

				$table = $resource->getTableName('eav/attribute_option_value');

				/*$selectOptionData = $readConnection->fetchAll('SELECT * FROM ' . $table .' WHERE
	    									option_id in (SELECT option_id FROM eav_attribute_option WHERE
											attribute_id = '.$attribute_id.' ORDER BY `eav_attribute_option`.`sort_order` ASC)
	    									AND store_id = '.$store_id);*/
				$selectOptionData = $readConnection->fetchAll('
					  SELECT eaov.* , eao.* FROM ' . $table .' eaov
					  LEFT JOIN eav_attribute_option eao
					  ON eaov.option_id = eao.option_id
					  WHERE eao.attribute_id = '.$attribute_id.' AND eaov.store_id = '.$store_id.'
					  ORDER BY eao.sort_order ASC ');

				/*	if ($attribute_code == "prb_extra_color")
				{
				echo 'SELECT * FROM ' . $table .' WHERE
	    									option_id in (SELECT option_id FROM eav_attribute_option WHERE
											attribute_id = '.$attribute_id.' ORDER BY `eav_attribute_option`.`sort_order` ASC)
	    									AND store_id = '.$store_id;
					print"<pre>";print_r($selectOptionData);print"</pre>";
				}*/
				if ($attribute_code == "prb_scissors_colour")
				{
					$html['data'] .= '<div'.$class.'> ';
					$i = 1;

					foreach($selectOptionData as $selectOption) {
						/*if($i==1)
							$selected = ' selectedColor';
						else
							$selected = '';*/

						$label = substr($selectOption['value'], 0,-10);
						$label = ($selectOption['value'] === 'Default') ? 'Default' : $label;
						$selectOption['value'] = substr($selectOption['value'], -7);
						$selected = ($selectOption['value'] == "#ffffff") ? ' selectedColor' : '';

						$html['data'] .= '<span name="'.$label.'"
						 				id="'.$attribute_code.'_'.str_replace(" ", "_", $label).'" class="colourClass'.$selected.'"
						 				val="'.$selectOption['value'].'"
						 				onclick="'.$attribute_code.'clickColour(\''.$selectOption['value'].'\',\''.$label.'\'); return false;"
						 				style="background-color:'.$selectOption['value'].'; border:2px solid '.$selectOption['value'].';"></span>';
						$i++;
					}
					$html['data'] .= "</div>";
				}
				else
				{
					$html['data'] .= '<div'.$class.'> ';
					$i = 1;
					//print_r($selectOptionData);exit;	
					foreach($selectOptionData as $selectOption) {
						if($i==1)
							$selected = ' selectedColor';
						else
							$selected = '';

						$wholeLabel = substr($selectOption['value'], 0,-10);
						$pos   = strrpos($wholeLabel, '|');
						$label =substr($wholeLabel,0,($pos-1));
						$printer = substr($wholeLabel,($pos+1));

						$label = ($selectOption['value'] === 'Default') ? 'Default' : $label;
						$selectOption['value'] = substr($selectOption['value'], -7);
						$html['data'] .= '<span name="'.$printer.'"
						 				id="'.$attribute_code.'_'.str_replace(" ", "_", $label).'" class="colourClass'.$selected.'"
						 				val="'.$selectOption['value'].'"
						 				onclick="'.$attribute_code.'clickColour(\''.$selectOption['value'].'\',\''.$label.'\'); return false;"
						 				style="background-color:'.$selectOption['value'].'; border:2px solid '.$selectOption['value'].';"></span>';
						$i++;
					}
					$html['data'] .= "</div>";
					//style="float:left;margin:2px;background-color:'.$selectOption['value'].';color:'.$selectOption['value'].';width:35px;height:25px; border: 1px solid black; cursor:pointer"
				}
				break;
    		case 'textarea':
    			$html['data'] .= '<textarea name="'.$attribute_code.'" id="'.$attribute_code.'_textarea" '.$class.'></textarea>';//'.$attribute_code.'
    			break;
    		case 'text':
    			$html['data'] .= '<text name="'.$attribute_code.'" id="'.$attribute_code.'_text" '.$class.'></text>';
    			break;
    		case 'media_image':
    			$html['data'] .= '<input type="file" name="'.$attribute_code.'" />';
    	}
    	return $html;
    }

    public function getClipArtFolderList() {
    	$dir = Mage::getBaseDir('base').'/media/clipart';
		$dirList = scandir($dir);
		$i = 1;
		foreach($dirList as $dir) {
			if($dir != '.' && $dir != '..') {
				if($dir == 'Emotions') {
					$dirArr[0] = $dir;
				} else {
					$dirArr[$i] = $dir;
					$i++;
				}
			}
		}
		ksort($dirArr);
		return $dirArr;
    }
	/*
	 * Get Scissor patterns
	 */
    public function getScissorPatterns() {
    	$fld = Mage::getBaseDir('base').'/media/patterns';
		$patterns = array();
		if ($dh = opendir($fld))
		{
		    while (($file = readdir($dh)) !== false)
		    {
		    	if($file != '.' && $file != '..')
		    	{
		    		$patterns[] = $file;
		    		ksort($patterns);
		    	}
		    }

		}
		return $patterns;
    }
	

	

	

    /* Get products that can be personalized for Choose Products Functionality
	 * @return Mage_Catalog_Model_Product collection
	 */
    public function getCustomProducts()
    {
    	 $collection = Mage::getResourceModel('catalog/product_collection')
			          ->addAttributeToSelect('*')
			          ->addAttributeToFilter('type_id', array('eq' => 'customproduct'))
			          ->addAttributeToFilter('status',1)
			          ->addAttributeToSort('id','ASC')
			          ->setPageSize(20)
			          ->setCurPage(1);
		return $collection;
    }

    public function usortArray($items)
    {
		usort($items, function($a, $b)
		{
		    if ($a['value'] == $b['value'])
		    	return 0;
		    return ($a['value'] < $b['value']) ? -1 : 1;
		});

		return $items;
    }

}

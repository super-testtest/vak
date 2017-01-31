<?php
class Tailored_PMS_Block_Adminhtml_Pms_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("pms_form", array("legend"=>Mage::helper("pms")->__("Item information")));

				
						$fieldset->addField("pms", "text", array(
						"label" => Mage::helper("pms")->__("PMS Code"),
						"name" => "pms",
						));
					
						$fieldset->addField("hex", "text", array(
						"label" => Mage::helper("pms")->__("Color Code"),
						"name" => "hex",
						));
					

				if (Mage::getSingleton("adminhtml/session")->getPmsData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getPmsData());
					Mage::getSingleton("adminhtml/session")->setPmsData(null);
				} 
				elseif(Mage::registry("pms_data")) {
				    $form->setValues(Mage::registry("pms_data")->getData());
				}
				return parent::_prepareForm();
		}
}

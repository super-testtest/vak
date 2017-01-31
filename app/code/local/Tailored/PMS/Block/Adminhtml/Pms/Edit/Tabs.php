<?php
class Tailored_PMS_Block_Adminhtml_Pms_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("pms_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("pms")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("pms")->__("Item Information"),
				"title" => Mage::helper("pms")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("pms/adminhtml_pms_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}

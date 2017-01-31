<?php

class Tailored_PMS_Block_Adminhtml_Pms_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("pmsGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("pms/pms")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("pms")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("pms", array(
				"header" => Mage::helper("pms")->__("PMS Code"),
				"index" => "pms",
				));
				$this->addColumn("hex", array(
				"header" => Mage::helper("pms")->__("Color Code"),
				"index" => "hex",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_pms', array(
					 'label'=> Mage::helper('pms')->__('Remove Pms'),
					 'url'  => $this->getUrl('*/adminhtml_pms/massRemove'),
					 'confirm' => Mage::helper('pms')->__('Are you sure?')
				));
			return $this;
		}
			

}
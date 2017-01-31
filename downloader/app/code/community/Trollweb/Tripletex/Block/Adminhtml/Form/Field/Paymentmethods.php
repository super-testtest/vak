<?php
/**
 * Tripletex Integration
 *
 * LICENSE AND USAGE INFORMATION
 * It is NOT allowed to modify, copy or re-sell this file or any
 * part of it. Please contact us by email at post@trollweb.no or
 * visit us at www.trollweb.no/bbs if you have any questions about this.
 * Trollweb is not responsible for any problems caused by this file.
 *
 * Visit us at http://www.trollweb.no today!
 *
 * @category   Trollweb
 * @package    Trollweb_Tripletex
 * @copyright  Copyright (c) 2009 Trollweb (http://www.trollweb.no)
 * @license    Single-site License
 *
 */

class Trollweb_Tripletex_Block_Adminhtml_Form_Field_Paymentmethods extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
	 protected $_storedescRenderer;

	 /*
	 public function __construct()
	 {
    $this->_prepareToRender();
	 	parent::__construct();
	 }
	 */

	  /**
	   * Prepare to render
	   */
    public function _prepareToRender()
    {
        $this->addColumn('magento_method', array(
            'label' => Mage::helper('tripletex')->__('Magento'),
            'style' => 'width:120px',
            'renderer' => $this->_getMagentoPaymentmethods(),
        ));
        $this->addColumn('tripletex_method', array(
            'label' => Mage::helper('tripletex')->__('Tripletex'),
            'style' => 'width:120px',
        ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('adminhtml')->__('Add store');
    }

    /**
     * Retrieve group column renderer
     *
     * @return Mage_CatalogInventory_Block_Adminhtml_Form_Field_Customergroup
     */
    protected function _getMagentoPaymentmethods()
    {
        if (!$this->_storedescRenderer) {
        	if ($this->getLayout()) {
            $this->_storedescRenderer = $this->getLayout()->createBlock(
                'tripletex/adminhtml_form_field_methodselect', '',
                array('is_render_to_js_template' => true, 'ss' => 'A:'.$this->getScopeId())
            );
          }
        }
        return $this->_storedescRenderer;
    }

    /**
     * Prepare existing row data object
     *
     * @param Varien_Object
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getMagentoPaymentmethods()->calcOptionHash($row->getData('magento_method')),
            'selected="selected"'
        );
    }

}

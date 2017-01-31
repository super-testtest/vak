<?php

class Trollweb_Paybybill_Block_Adminhtml_Form_Field_Socialtitle extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
   protected $_socialTitlesRenderer;
   protected $_magentoSocialTitleRenderer;
   protected $_prefixes;


    public function __construct()
    {
      $this->_prepareToRender();
      parent::__construct();
    }

   /**
     * Prepare to render
     */
    public function _prepareToRender()
    {
        $this->addColumn('social_title', array(
            'label' => Mage::helper('paybybill')->__('Magento social title'),
            'style' => 'width:120px',
        		'renderer' => $this->_getMagentoSocialTitles(),
        ));
        $this->addColumn('pbb_social_title', array(
            'label' => Mage::helper('paybybill')->__('PBB Social title'),
            'style' => 'width:50px',
            'renderer' => $this->_getPBBSocialTitles(),
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('paybybill')->__('Add mapping');
    }

    /**
     * Retrieve group column renderer
     *
     */
    protected function _getMagentoSocialTitles()
    {
        if (!$this->_magentoSocialTitleRenderer) {
          if ($this->getLayout()) {
            $this->_magentoSocialTitleRenderer = $this->getLayout()->createBlock(
                'paybybill/adminhtml_form_html_select', '',
                array('is_render_to_js_template' => true)
            );

            foreach ($this->getPrefixes() as $prefix) {
              $this->_magentoSocialTitleRenderer->addOption($prefix,$prefix);
            }

          }
        }
        return $this->_magentoSocialTitleRenderer;
    }

    /**
     * Retrieve group column renderer
     *
     */
    protected function _getPBBSocialTitles()
    {
        if (!$this->_socialTitlesRenderer) {
          if ($this->getLayout()) {
            $this->_socialTitlesRenderer = $this->getLayout()->createBlock(
                'paybybill/adminhtml_form_html_select', '',
                array('is_render_to_js_template' => true)
            );
            $this->_socialTitlesRenderer->addOption('Mr','Mr');
            $this->_socialTitlesRenderer->addOption('Mrs','Mrs');
          }
        }
        return $this->_socialTitlesRenderer;
    }

    protected function getPrefixes()
    {
      if (!isset($this->_prefixes)) {
        $section = 'customer';
        $website = Mage::app()->getRequest()->getParam('website');
        $config = Mage::getModel('adminhtml/config_data')
            ->setSection($section)
            ->setWebsite($website)
            ->load();

        if (!isset($config['customer/address/prefix_options'])) {
          $config = Mage::getModel('adminhtml/config_data')
              ->setSection($section)
              ->load();
        }

        if (isset($config['customer/address/prefix_options'])) {
          $prefixes = explode(";",$config['customer/address/prefix_options']);
        }
        else {
          $prefixes = array();
        }
        $this->_prefixes = array();
        foreach ($prefixes as $prefix) {
          if (!empty($prefix)) {
            $this->_prefixes[] = $prefix;
          }
        }
      }
      return $this->_prefixes;
    }

    protected function _toHtml()
    {
      if (count($this->getPrefixes())) {
        return parent::_toHtml();
      }
      else {
        return Mage::helper('paybybill')->__('No prefixes is defined in Magento. To use this feature add prefixes in the Prefix Dropdown Options under System -> Configuration -> Customer Configuration -> Name and Address Options');
      }
    }

    /**
     * Prepare existing row data object
     *
     * @param Varien_Object
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {

        $row->setData(
            'option_extra_attr_' . $this->_getMagentoSocialTitles()->calcOptionHash($row->getData('social_title')),
            'selected="selected"'
        );

        $row->setData(
            'option_extra_attr_' . $this->_getPBBSocialTitles()->calcOptionHash($row->getData('pbb_social_title')),
            'selected="selected"'
        );

    }

}

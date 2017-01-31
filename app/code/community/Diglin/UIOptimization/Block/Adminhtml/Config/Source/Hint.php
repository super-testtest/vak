<?php
/**
 * Diglin
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * @category    Diglin
 * @package     Diglin_UIOptimization
 * @copyright   Copyright (c) 2011-2012 Diglin (http://www.diglin.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Diglin_UIOptimization_Block_Adminhtml_Config_Source_Hint
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{

    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $version = Mage::getConfig()->getModuleConfig('Diglin_UIOptimization')->version;
        
         $block = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('adminhtml')->__('Flush JavaScript/CSS Cache'),
                    'onclick'   => "setLocation('" . $this->getUrl('*/cache/cleanMedia') ."');",
                ));
                
        return '' . $block->toHtml() .' ('. $this->__('You will be redirected to the Cache Management page with a successful message') .')</p>';
    }
}
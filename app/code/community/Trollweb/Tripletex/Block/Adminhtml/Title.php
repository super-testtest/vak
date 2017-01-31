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
 * @copyright  Copyright (c) 2010 Trollweb (http://www.trollweb.no)
 * @license    Single-site License
 *
 */


class Trollweb_Tripletex_Block_Adminhtml_Title extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{

    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
      $v = (array)Mage::getConfig()->getNode('modules')->children();
      $module = implode("_",array_slice(explode("_",get_class($this)),0,2));
      $ver = (string)$v[$module]->version;

      if (!empty($ver)) {
        $element->setLegend($element->getLegend().' (version '.$ver.')');
      }

      return parent::render($element);
    }

}

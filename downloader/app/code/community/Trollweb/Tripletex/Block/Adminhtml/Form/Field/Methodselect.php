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
class Trollweb_Tripletex_Block_Adminhtml_Form_Field_Methodselect extends Mage_Core_Block_Html_Select
{
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {

            $store = $this->getRequest()->getParam('store');
            $storeId = false;
            if ($store)
            {
              $storeId = (int)Mage::getConfig()->getNode('stores/' . $store . '/system/store/id');
            }

            $methods = Mage::helper('payment')->getPaymentMethodList(true, true); // Mage::getSingleton('payment/config')->getAllMethods();
            $activeMethods = array_keys(Mage::getSingleton('payment/config')->getActiveMethods($storeId));
            foreach ($methods as $method => $title)
            {
              if (in_array($method,$activeMethods)) { $title['label'] .= '*'; }
              $this->addOption($method,$title['label']);
            }
            /*foreach ($methods as $method => $data) {
              if ($data->getTitle()) {
                $title = $data->getTitle();
                if (in_array($method,$activeMethods)) { $title .= '*'; }
                $this->addOption($method,$title);
              }
            }
            */
        }
        return parent::_toHtml();
    }
}
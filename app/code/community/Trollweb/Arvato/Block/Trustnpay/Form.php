<?php
class Trollweb_Arvato_Block_Trustnpay_Form extends Mage_Payment_Block_Form {
    protected function _construct() {
        parent::_construct();
        $this->setTemplate('arvato/trustnpay/form.phtml');
    }

    protected function getLogoUrl() {
        return $this->getSkinUrl('arvato/img/'.$this->getMethod()->getLogo());
    }
}

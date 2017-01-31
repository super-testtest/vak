<?php
class Trollweb_Arvato_Block_Trustnpay_Info extends Mage_Payment_Block_Info {
    protected function _construct() {
        parent::_construct();
        $this->setTemplate('arvato/trustnpay/info.phtml');
    }

    protected function _prepareSpecificInformation($transport = null) {
        $transport = parent::_prepareSpecificInformation($transport);
        $info = $this->getInfo();
        $additionalInfo = $info->getAdditionalInformation();
        $data = array();
        foreach($additionalInfo as $key => $val) {
            if (!stristr($key, 'arvato')){
                continue;
            }
            if (!$this->getIsSecureMode()) {
                $data[Mage::helper('arvato')->__($key)] = $val;
            }
        }
        return $transport->setData(array_merge($data, $transport->getData()));
    }
}

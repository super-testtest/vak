<?php

class Trollweb_Paybybill_Block_Formpp extends Trollweb_Paybybill_Block_Form
{

    protected $_pbb_template = 'paybybill/form_partpayment.phtml';


    public function getConditionsLink()
    {
      switch (strtolower($this->getLanguageCode())) {
        case 'no': return 'http://www.gothiagroup.com/fileadmin/Norway/pdf/PBB_rammkreditt_standard.pdf';
        default: return 'http://www.gothiagroup.com';
      }
    }

}

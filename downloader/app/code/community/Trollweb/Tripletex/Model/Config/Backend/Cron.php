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

class Trollweb_Tripletex_Model_Config_Backend_Cron extends Mage_Core_Model_Config_Data
{

    const TRIPLETEX_CRON_STRING_PATH  = 'crontab/jobs/trollweb_tripletex/schedule/cron_expr';
    const TRIPLETEX_CRON_MODEL_PATH   = 'crontab/jobs/trollweb_tripletex/run/model';

   /**
     * Cron settings after save
     *
     */
    protected function _afterSave()
    {
        $enabled    = $this->getData('groups/tripletex_cron/fields/active/value');
        $time       = $this->getData('groups/tripletex_cron/fields/crontime/value');

        if ($enabled) {
          switch ($time) {
            case 'minutely':
              $cronExprArray = array('*/5','*','*','*','*');
              break;
            case 'hourly':
              $cronExprArray = array('0','*','*','*','*');
              break;
            default:
            case 'daily':
              $cronExprArray = array('0','23','*','*','*');
              break;
          }
          $cronExprString = join(' ', $cronExprArray);
        }
        else {
            $cronExprString = '';
        }

        try {
            Mage::getModel('core/config_data')
                ->load(self::TRIPLETEX_CRON_STRING_PATH, 'path')
                ->setValue($cronExprString)
                ->setPath(self::TRIPLETEX_CRON_STRING_PATH)
                ->save();

            Mage::getModel('core/config_data')
                ->load(self::TRIPLETEX_CRON_MODEL_PATH, 'path')
                ->setValue((string) Mage::getConfig()->getNode(self::TRIPLETEX_CRON_MODEL_PATH))
                ->setPath(self::TRIPLETEX_CRON_MODEL_PATH)
                ->save();
        }
        catch (Exception $e) {
            Mage::throwException(Mage::helper('adminhtml')->__('Unable to save the cron expression.'));
        }

    }

    public function afterCommitCallback()
    {
      parent::afterCommitCallback();
      if (!$this->getData('groups/tripletex_settings/fields/testmode/value')) {
     	  $api = Mage::getModel('tripletex/tripletex_api');
     	  $username = $this->getData('groups/tripletex_settings/fields/username/value');
     	  $password = $this->getData('groups/tripletex_settings/fields/password/value');

     	  if (!$api->setLogin($username,$password)) {
     	    Mage::throwException(Mage::helper('adminhtml')->__('Unable to login to Tripletex. Username or password for api is not correct.'));
     	  }
      }

      return $this;
    }
}

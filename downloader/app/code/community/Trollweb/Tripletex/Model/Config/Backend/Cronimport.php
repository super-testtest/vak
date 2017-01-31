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
 * @copyright  Copyright (c) 2011 Trollweb (http://www.trollweb.no)
 * @license    Single-site License
 *
 */

class Trollweb_Tripletex_Model_Config_Backend_Cronimport extends Mage_Core_Model_Config_Data
{

    const TRIPLETEX_CRON_STRING_PATH  = 'crontab/jobs/trollweb_tripletex_checkinvoice/schedule/cron_expr';
    const TRIPLETEX_CRON_MODEL_PATH   = 'crontab/jobs/trollweb_tripletex_checkinvoice/run/model';

   /**
     * Cron settings after save
     *
     */
    protected function _afterSave()
    {
        $enabled    = $this->getData('groups/tripletex_cron/fields/import_active/value');
        $time       = $this->getData('groups/tripletex_cron/fields/import_crontime/value');

        if ($enabled) {
          switch ($time) {
            case 'hourly':
              $cronExprArray = array('0','*','*','*','*');
              break;
            case '12hour':
              $cronExprArray = array('00','01,13','*','*','*');
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

}

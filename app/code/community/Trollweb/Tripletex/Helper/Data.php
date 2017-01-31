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

/**
 * Data helper
 */
class Trollweb_Tripletex_Helper_Data extends Mage_Core_Helper_Abstract
{

    const STATUS_NOT_EXPORTED = 0;
    const STATUS_EXPORTED = 1;
    const STATUS_ERROR = 2;

	public function getStatuses()
	{
		return array('0' => $this->__('Ikke eksportert'), 
					 '1' => $this->__('Eksportert'),
                     '2' => $this->__('Feil ved overføring'),
								);
	}
  
} 

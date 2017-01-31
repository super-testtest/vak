<?php
/**
 * File used to display a invoice fee on a order
 *
 * PHP Version 5.2
 *
 * @category Payment
 * @package  Klarna_Module_Magento
 * @author   MS Dev <ms.modules@klarna.com>
 * @license  http://opensource.org/licenses/BSD-2-Clause BSD2
 * @link     http://integration.klarna.com
 */

/**
 * Class used to add the invoice fee to a order
 *
 * @category Payment
 * @package  Klarna_Module_Magento
 * @author   MS Dev <ms.modules@klarna.com>
 * @license  http://opensource.org/licenses/BSD-2-Clause BSD2
 * @link     http://integration.klarna.com
 */
class Klarna_KlarnaPaymentModule_Block_Order_Totals_Fee
    extends Mage_Sales_Block_Order_Totals
{

    // @codingStandardsIgnoreStart method name required by Magento
    /**
     * Initialize order totals array
     *
     * @return Klarna_KlarnaPaymentModule_Block_Order_Totals_Fee
     */
    public function _initTotals()
    {
        parent::_initTotals();
        $payment = $this->getOrder()->getPayment();
        if ($payment->getMethod() != "klarna_invoice") {
            return $this;
        }
        $info = $payment->getMethodInstance()->getInfoInstance();
        if (!$info->getAdditionalInformation("invoice_fee")) {
            return $this;
        }
        return Mage::helper('klarnaPaymentModule/total')->addToBlock($this);
    }
    // @codingStandardsIgnoreEnd

}

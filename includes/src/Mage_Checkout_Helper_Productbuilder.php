<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Shopping cart helper
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Checkout_Helper_Productbuilder extends Mage_Core_Helper_Url
{
    /**
     * XML path for redirect to cart value
     */
    const XML_PATH_REDIRECT_TO_CART = 'checkout/productbuilder/redirect_to_cart';

    /**
     * Maximal coupon code length according to database table definitions (longer codes are truncated)
     */
    const COUPON_CODE_MAX_LENGTH = 255;

    /**
     * Retrieve cart instance
     *
     * @return Mage_Checkout_Model_Cart
     */
    public function getCart()
    {
        return Mage::getSingleton('checkout/productbuilder');
    }

    /**
     * Retrieve url for add product to cart
     *
     * @param Mage_Catalog_Model_Product $product
     * @param array $additional
     * @return string
     */
    public function getAddUrl($product, $additional = array())
    {
        $routeParams = array(
            Mage_Core_Controller_Front_Action::PARAM_NAME_URL_ENCODED => $this->_getHelperInstance('core')
                ->urlEncode($this->getCurrentUrl()),
            'product' => $product->getEntityId(),
            Mage_Core_Model_Url::FORM_KEY => $this->_getSingletonModel('core/session')->getFormKey()
        );

        if (!empty($additional)) {
            $routeParams = array_merge($routeParams, $additional);
        }

        if ($product->hasUrlDataObject()) {
            $routeParams['_store'] = $product->getUrlDataObject()->getStoreId();
            $routeParams['_store_to_url'] = true;
        }

        if ($this->_getRequest()->getRouteName() == 'checkout'
            && $this->_getRequest()->getControllerName() == 'productbuilder') {
            $routeParams['in_cart'] = 1;
        }

        return $this->_getUrl('checkout/productbuilder/add', $routeParams);
    }

    /**
     * Return helper instance
     *
     * @param  string $helperName
     * @return Mage_Core_Helper_Abstract
     */
    protected function _getHelperInstance($helperName)
    {
        return Mage::helper($helperName);
    }

    /**
     * Retrieve url for remove product from cart
     *
     * @param   Mage_Sales_Quote_Item $item
     * @return  string
     */
    public function getRemoveUrl($item)
    {
        $params = array(
            'id' => $item->getId(),
            Mage_Core_Controller_Front_Action::PARAM_NAME_BASE64_URL => $this->getCurrentBase64Url()
        );
        return $this->_getUrl('checkout/productbuilder/delete', $params);
    }

    /**
     * Retrieve shopping cart url
     *
     * @return unknown
     */
    public function getProductbuilderUrl()
    {
        return $this->_getUrl('checkout/productbuilder');
    }

    /**
     * Retrieve current quote instance
     *
     * @return Mage_Sales_Model_Quote
     */
    public function getQuote()
    {
        return Mage::getSingleton('checkout/session')->getQuote();
    }

    /**
     * Get shopping cart items count
     *
     * @return int
     */
    public function getItemsCount()
    {
        return $this->getProductbuilder()->getItemsCount();
    }

    /**
     * Get shopping cart summary qty
     *
     * @return decimal
     */
    public function getItemsQty()
    {
        return $this->getProductbuilder()->getItemsQty();
    }

    /**
     * Get shopping cart items summary (inchlude config settings)
     *
     * @return decimal
     */
    public function getSummaryCount()
    {
        return $this->getProductbuilder()->getSummaryQty();
    }

    /**
     * Check qoute for virtual products only
     *
     * @return bool
     */
    public function getIsVirtualQuote()
    {
        return $this->getQuote()->isVirtual();
    }

    /**
     * Checks if customer should be redirected to shopping cart after adding a product
     *
     * @param int|string|Mage_Core_Model_Store $store
     * @return bool
     */
    public function getShouldRedirectToProductbuilder($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_REDIRECT_TO_CART, $store);
    }
}

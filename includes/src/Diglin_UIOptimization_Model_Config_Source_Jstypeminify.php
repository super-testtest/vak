<?php
/**
 * Diglin
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * @category    Diglin
 * @package     Diglin_UIOptimization
 * @copyright   Copyright (c) 2011-2012 Diglin (http://www.diglin.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Diglin_UIOptimization_Model_Config_Source_Jstypeminify
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'jsmin', 'label' => 'JSMin (Good ratio)'),
            array('value' => 'yuicompressor', 'label' => 'YUICompressor (recommended if java available)'),
            //array('value' => 'packer', 'label' => 'Packer from Dean Edwards (best compression / less Magento compatible)'),
        );
    }
}
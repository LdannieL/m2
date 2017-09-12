<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Catalog Custom Options Config Renderer
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
namespace Unit6\SystemConfig\Block\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Custom extends Field
{
    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return "HELLO WORLD!";
    }
}

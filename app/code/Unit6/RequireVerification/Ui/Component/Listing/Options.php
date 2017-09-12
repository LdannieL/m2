<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\RequireVerification\Ui\Component\Listing;

class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

        $this->options = array(
            array(
                'label' => '0',
                'value' => 0
            ),
            array(
                'label' => '1',
                'value' => 1
            ),
        );

        return $this->options;
    }
}

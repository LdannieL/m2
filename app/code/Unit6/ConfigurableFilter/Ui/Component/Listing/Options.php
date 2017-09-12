<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ConfigurableFilter\Ui\Component\Listing;

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
                'label' => ' ',
                'value' => 0
            ),
            array(
                'label' => 'One',
                'value' => 1
            ),
            array(
                'label' => 'Two',
                'value' => 2
            ),
            array(
                'label' => 'Three',
                'value' => 3
            ),

        );

        return $this->options;
    }
}

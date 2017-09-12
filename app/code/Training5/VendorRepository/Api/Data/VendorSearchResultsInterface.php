<?php 

namespace Training5\VendorRepository\Api\Data;

interface VendorSearchResultsInterface
    extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @api
     * @return \Training\Repository\Api\Data\ExampleInterface[]
     */
    public function getItems();

    /**
     * @api
     * @param \Training\Repository\Api\Data\ExampleInterface[] $items
     * @return $this
     */
    public function setItems(array $items = null);
}

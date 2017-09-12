<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Ui\Component\Form;

use Magento\Framework\View\Element\UiComponent\DataProvider\FilterPool;
use Unit6\ComputerGames\Model\ResourceModel\Game\CollectionFactory as GamesCollectionFactory;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var Config
     */
    protected $eavConfig;

    /**
     * @var FilterPool
     */
    protected $filterPool;

    /**
     * @var array
     */
    protected $loadedData;


    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        GamesCollectionFactory $collectionFactory,
        FilterPool $filterPool,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->filterPool = $filterPool;
    }


    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->loadedData) {
            $items = $this->collection->getItems();
            $result = array();
            foreach ($items as $item) {
                $result['computer_games'] = $item->getData();
                $this->loadedData[$item->getGameId()] = $result;
                break;
            }
        }
        return $this->loadedData;
    }

}

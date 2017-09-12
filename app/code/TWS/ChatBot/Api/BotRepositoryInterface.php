<?php
namespace TWS\ChatBot\Api;

use TWS\ChatBot\Api\Data\BotInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface BotRepositoryInterface 
{
    public function save(BotInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(BotInterface $page);

    public function deleteById($id);
}

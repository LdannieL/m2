<?php

namespace Unit6\RequireVerification\Controller\Adminhtml\Order;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class Verify extends \Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction
{

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        parent::__construct($context, $filter);
        $this->collectionFactory = $collectionFactory;
    }


    protected function massAction(AbstractCollection $collection)
    {
        foreach ($collection as $order) {
            $order->setRequireVerification(0)
              ->save();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath($this->getComponentRefererUrl());
        return $resultRedirect;
    }

}
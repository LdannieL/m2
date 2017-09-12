<?php
namespace Pulsestorm\ToDoCrud\Controller\Adminhtml\Viewlog;

class Index extends \Magento\Backend\App\Action
{
    protected $coreRegistry;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

        /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Pulsestorm_ToDoCrud::pulsestorm_admin_todocrud_menu')
            ->addBreadcrumb(__('ToDo'), __('ToDo'))
            ->addBreadcrumb(__('Manage ToDos'), __('Manage ToDos'));
        return $resultPage;
    }

    /**
     * Edit ToDo block
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Pulsestorm\ToDoCrud\Model\TodoItem');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This ToDo no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        // 3. Set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        // 4. Register model to use later in blocks
        $this->_coreRegistry->register('pulsestorm_todo', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        // $resultPage = $this->resultPageFactory->create();

        // 5. Build edit form
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit ToDo') : __('New ToDo'),
            $id ? __('Edit ToDo') : __('New ToDo')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('ToDos'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getIndexText() : __('New ToDo'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Pulsestorm_ToDoCrud::menu_1');
    }            
        
}

<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Pulsestorm\ToDoCrud\Block\Adminhtml\ToDo\Edit;

/**
 * Adminhtml cms block edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('todo_form');
        $this->setTitle(__('ToDo Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('pulsestorm_todo');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('todo_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getPulsestormTodocrudTodoitemId()) {
            $fieldset->addField('pulsestorm_todocrud_todoitem_id', 'hidden', ['name' => 'pulsestorm_todocrud_todoitem_id']);
        }

        $fieldset->addField(
            'item_text',
            'text',
            ['name' => 'item_text', 'label' => __('ToDo Title'), 'title' => __('ToDo Title'), 'required' => true]
        );

        // $fieldset->addField(
        //     'identifier',
        //     'text',
        //     [
        //         'name' => 'identifier',
        //         'label' => __('Identifier'),
        //         'title' => __('Identifier'),
        //         'required' => true,
        //         'class' => 'validate-xml-identifier'
        //     ]
        // );

        /* Check is single store mode */
        // if (!$this->_storeManager->isSingleStoreMode()) {
        //     $field = $fieldset->addField(
        //         'store_id',
        //         'multiselect',
        //         [
        //             'name' => 'stores[]',
        //             'label' => __('Store View'),
        //             'title' => __('Store View'),
        //             'required' => true,
        //             'values' => $this->_systemStore->getStoreValuesForForm(false, true)
        //         ]
        //     );
        //     $renderer = $this->getLayout()->createBlock(
        //         'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
        //     );
        //     $field->setRenderer($renderer);
        // } else {
        //     $fieldset->addField(
        //         'store_id',
        //         'hidden',
        //         ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
        //     );
        //     $model->setStoreId($this->_storeManager->getStore(true)->getId());
        // }

        // $fieldset->addField(
        //     'is_active',
        //     'select',
        //     [
        //         'label' => __('Status'),
        //         'title' => __('Status'),
        //         'name' => 'is_active',
        //         'required' => true,
        //         'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
        //     ]
        // );
        // if (!$model->getId()) {
        //     $model->setData('is_active', '1');
        // }

        // $fieldset->addField(
        //     'content',
        //     'editor',
        //     [
        //         'name' => 'content',
        //         'label' => __('Content'),
        //         'title' => __('Content'),
        //         'style' => 'height:36em',
        //         'required' => true,
        //         'config' => $this->_wysiwygConfig->getConfig()
        //     ]
        // );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}

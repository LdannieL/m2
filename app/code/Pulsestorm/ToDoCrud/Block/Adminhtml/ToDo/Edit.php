<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Pulsestorm\ToDoCrud\Block\Adminhtml\ToDo;

/**
 * CMS block edit form container
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'pulsestorm_todocrud_todoitem_id';
        $this->_blockGroup = 'Pulsestorm_ToDoCrud';
        $this->_controller = 'adminhtml_todo'; // defines block path  together with $this->_blockGroup, so block is Pulsestorm/ToDoCrud/Block/Adminhtml/Todo/Edit.php

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save ToDo'));
        $this->buttonList->update('delete', 'label', __('Delete ToDo'));

        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ],
            -100
        );

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('item_text') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'item_text');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'item_text');
                }
            }
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('pulsestorm_todo')->getPulsestormTodocrudTodoitemId()) {
            return __("Edit ToDo '%1'", $this->escapeHtml($this->_coreRegistry->registry('pulsestorm_todo')->getItemText()));
        } else {
            return __('New ToDo');
        }
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('pulsestorm_admin_todocrud/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}

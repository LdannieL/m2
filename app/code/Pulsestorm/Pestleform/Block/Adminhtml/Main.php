<?php
namespace Pulsestorm\Pestleform\Block\Adminhtml;
class Main extends \Magento\Backend\Block\Template
{
	// protected function _construct()
 //    {
 //        $this->_controller = 'adminhtml_index';
 //        $this->_blockGroup = 'Pulsestorm_Pestleform';
 //        $this->_headerText = __('Manage Things');

 //        parent::_construct();

 //        if ($this->_isAllowedAction('Pulsestorm_Pestleform::things')) {
 //            $this->buttonList->update('add', 'label', __('Add New Thing'));
 //        } else {
 //            $this->buttonList->remove('add');
 //        }
 //    }

 //    protected function _isAllowedAction($resourceId)
 //    {
 //        return $this->_authorization->isAllowed($resourceId);
 //    }
     /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_index';
        $this->_blockGroup = 'Pulsestorm_Pestleform';
        $this->_headerText = __('Manage Things');
        $this->_addButtonLabel = __('Add New Thing');
        parent::_construct();
    }

    // function _prepareLayout(){}
}

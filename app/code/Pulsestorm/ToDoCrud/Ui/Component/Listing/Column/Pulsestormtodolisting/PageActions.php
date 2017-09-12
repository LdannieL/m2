<?php
namespace Pulsestorm\ToDoCrud\Ui\Component\Listing\Column\Pulsestormtodolisting;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class PageActions extends \Magento\Ui\Component\Listing\Columns\Column
{

    /** Url path */
    const TODO_URL_PATH_EDIT = 'pulsestorm_admin_todocrud/viewlog/index';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::TODO_URL_PATH_EDIT
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = "X";
                if(isset($item["pulsestorm_todocrud_todoitem_id"]))
                {
                    $id = $item["pulsestorm_todocrud_todoitem_id"];
                }
                $item[$name]["view"] = [
                    // "href"=>$this->getContext()->getUrl(
                    //     // "adminhtml/pulsestorm_todo_listing/viewlog",["id"=>$id]),
                    //     "adminhtml/pulsestorm_admin_todocrud/viewlog/index",["id"=>$id]),
                    'href' => $this->urlBuilder->getUrl($this->editUrl, ['id' => $id]),
                    "label"=>__("Edit")
                ];
            }
        }

        return $dataSource;
    }    
    
}

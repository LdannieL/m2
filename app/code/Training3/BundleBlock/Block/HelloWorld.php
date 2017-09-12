<?php
namespace Training3\BundleBlock\Block;

class HelloWorld extends \Magento\Framework\View\Element\AbstractBlock
{
	protected function _toHtml()
	{
		return "<b>Hello world!</b>";
	}
}
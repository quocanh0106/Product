<?php

namespace AHT\Product\Helper;

use AHT\Product\Model\ResourceModel\Product\Grid\CollectionFactory;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
	protected $_collectionFactory;
	protected $scopeConfig;
	public function __construct(CollectionFactory $collectionFactory,ScopeConfigInterface $scopeConfig)
	{
		$this->_collectionFactory = $collectionFactory;
		$this->scopeConfig = $scopeConfig;
	}

	public function getProductByCate($id)
	{
		$product = $this->_collectionFactory->create();
		$result = $product->addFieldToFilter('categoryid', $id)->getData();
		return $result;
	}
	public function getConfigValue($field)
	{
		return $this->scopeConfig->getValue('product/product/' . $field, ScopeInterface::SCOPE_STORE);
	}
	public function getConfigValueSlide($field)
	{
		return $this->scopeConfig->getValue('product/productslide/' . $field, ScopeInterface::SCOPE_STORE);
	}
	public function getConfigNumberProduct($field)
	{
		return $this->scopeConfig->getValue('product/productslide/' . $field, ScopeInterface::SCOPE_STORE);
	}
	public function getConfigNumberProductSlide($field)
	{
		return $this->scopeConfig->getValue('product/productslide/' . $field, ScopeInterface::SCOPE_STORE);
	}
}

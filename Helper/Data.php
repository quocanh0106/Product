<?php 
namespace AHT\Product\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    public function getConfigValue($field)
	{
		return $this->scopeConfig->getValue('product/product/'.$field, ScopeInterface::SCOPE_STORE);
	}
    public function getConfigValueSlide($field)
	{
		return $this->scopeConfig->getValue('product/productslide/'.$field, ScopeInterface::SCOPE_STORE);
	}
    public function getConfigNumberProduct($field)
	{
		return $this->scopeConfig->getValue('product/productslide/'.$field, ScopeInterface::SCOPE_STORE);
	}
    public function getConfigNumberProductSlide($field)
	{
		return $this->scopeConfig->getValue('product/productslide/'.$field, ScopeInterface::SCOPE_STORE);
	}
}
<?php

namespace AHT\Product\Model\ResourceModel\Category;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'aht_product_collection';
	protected $_eventObject = 'Product_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('AHT\Product\Model\Category', 'AHT\Product\Model\ResourceModel\Category');
	}
}

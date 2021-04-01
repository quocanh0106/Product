<?php
namespace AHT\Product\Model\ResourceModel;

class Product extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    protected function _construct() 
    {
        $this->_init('aht_product', 'id');
    }
}
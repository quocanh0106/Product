<?php

namespace AHT\Product\Model\ResourceModel;

class Category extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('aht_category', 'id');
    }
}

<?php

namespace AHT\Product\Plugin;

use Magento\Framework\Interception;

class Product
{
    public function afterGetName(\AHT\Product\Model\Product $subject, $name)
    {
        return $name . '100';
    }
}

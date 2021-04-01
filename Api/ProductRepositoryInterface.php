<?php
namespace AHT\Product\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ProductRepositoryInterface
{
    /**
     * Save Post.
     *
     * @param \AHT\Product\Api\Data\ProductInterface $post
     * 
     * @return \AHT\Product\Api\Data\ProductInterface
     */
    public function save(\AHT\Product\Api\Data\ProductInterface $post);

    /**
     * Get object by id
     *
     * @return \AHT\Product\Api\Data\ProductInterface
     */
    public function getById(String $id);

}

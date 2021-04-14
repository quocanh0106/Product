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


    /**
     * Get All
     * 
     * @return \AHT\Product\Api\Data\ProductInterface
     */
    public function getList();

    /**
     * Create post.
     *
     * @param \AHT\Product\Api\Data\ProductInterface $post
     * 
     * @return \AHT\Product\Api\Data\ProductInterface
     */
    public function createPost(\AHT\Product\Api\Data\ProductInterface $post);

    /**
     * Update post
     *
     * @param String $id
     * @param \AHT\Blog\Api\Data\PostInterface $post
     * 
     * @return null
     */
    public function updatePost(String $id, \AHT\Product\Api\Data\ProductInterface $post);

    /**
     * Delete Post by ID.
     *
     * @param string $postId
     * @return \AHT\Product\Api\Data\ProductInterface
     */
    public function deleteById($postId);
}

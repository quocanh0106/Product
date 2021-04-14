<?php

namespace AHT\Product\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CategoryRepositoryInterface
{
    /**
     * Save Post.
     *
     * @param \AHT\Product\Api\Data\CategoryInterface $post
     * 
     * @return \AHT\Product\Api\Data\CategoryInterface
     */
    public function save(\AHT\Product\Api\Data\CategoryInterface $post);

    /**
     * Get object by id
     *
     * @return \AHT\Product\Api\Data\CategoryInterface
     */
    public function getById(String $id);


    /**
     * Get All
     * 
     * @return \AHT\Product\Api\Data\CategoryInterface
     */
    public function getList();

    /**
     * Create post.
     *
     * @param \AHT\Product\Api\Data\CategoryInterface $post
     * 
     * @return \AHT\Product\Api\Data\CategoryInterface
     */
    public function createPost(\AHT\Product\Api\Data\CategoryInterface $post);

    /**
     * Update post
     *
     * @param String $id
     * @param \AHT\Blog\Api\Data\PostInterface $post
     * 
     * @return null
     */
    public function updatePost(String $id, \AHT\Product\Api\Data\CategoryInterface $post);

    /**
     * Delete Post by ID.
     *
     * @param string $postId
     * @return \AHT\Product\Api\Data\CategoryInterface
     */
    public function deleteById($postId);
}

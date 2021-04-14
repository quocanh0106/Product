<?php

namespace AHT\Product\Api\Data;

interface ProductInterface
{
    const ID = 'id';

    /**
     * Get product id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set product id
     *
     * @param int $id
     * @return @this
     */
    public function setId($id);

    /**
     * Get product name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set product name
     *
     * @param string $nName
     * @return null
     */
    public function setName($name);

    /**
     * Get product images
     *
     * @return string|null
     */
    public function getImages();

    /**
     * Set product images
     *
     * @param string $images
     * @return null
     */
    public function setImages($images);

    /**
     * Get product categoryid
     *
     * @return int|null
     */
    public function getCategoryid();

    /**
     * Set product categoryid
     *
     * @param int $categoryid
     * @return @this
     */
    public function setCategoryid($categoryid);

    /**
     * Get product description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Set product description
     *
     * @param string $description
     * @return null
     */
    public function setDescription($description);

    /**
     * Get product price
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Set product price
     *
     * @param string $price
     * @return null
     */
    public function setPrice($price);

    /**
     * Get product new
     *
     * @return string|null
     */
    public function getNew();

    /**
     * Set product new
     *
     * @param string $is_new
     * @return null
     */
    public function setNew($is_new);
}

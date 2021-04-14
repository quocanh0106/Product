<?php

namespace AHT\Product\Api\Data;

interface CategoryInterface
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
    public function getNameCate();

    /**
     * Set product name
     *
     * @param string $nName
     * @return null
     */
    public function setNameCate($name_cate);
}

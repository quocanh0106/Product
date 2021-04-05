<?php
namespace AHT\Product\Model;

use \Magento\Framework\DataObject\IdentityInterface;
use AHT\Product\Api\Data\ProductInterface;

// class Product extends AbstractModel implements IdentityInterface
class Product extends \Magento\Framework\Model\AbstractModel implements IdentityInterface, ProductInterface {
    const CACHE_TAG = 'aht_product_post';

    protected $_cacheTag = 'aht_product_post';

    protected $_eventPrefix = 'aht_product_post';
    
    public function __construct(
   	 \Magento\Framework\Model\Context $context,
   	 \Magento\Framework\Registry $registry,
   	 \Magento\Framework\Model\ResourceModel\AbstractResource $resource =
   	 null,
   	 \Magento\Framework\Data\Collection\AbstractDb $resourceCollection =
   	 null,
   	 array $data = []
    ) {
   	 parent::__construct($context, $registry, $resource,$resourceCollection, $data);
    }
    public function _construct() {
		$this->_init('AHT\Product\Model\ResourceModel\Product');
    }    

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    public function getId()
    {
        return $this->getData('id');
    }
    public function setId($id)
    {
        $this->setData('id', $id);
    }
     
    public function getName()
    {
        return $this->getData('name');
    }
    public function setName($name)
    {
        $this->setData('name', $name);
    } 

    public function getImages()
    {
        return $this->getData('images');
    }
    public function setImages($images)
    {
        $this->setData('images', $images);
    } 

    public function getCategoryid()
    {
        return $this->getData('categoryid');
    }
    public function setCategoryid($categoryid)
    {
        $this->setData('categoryid', $categoryid);
    }

    public function getDescription()
    {
        return $this->getData('description');
    }
    public function setDescription($description)
    {
        $this->setData('description', $description);
    } 

    public function getPrice()
    {
        return $this->getData('price');
    }
    public function setPrice($price)
    {
        $this->setData('price', $price);
    } 
}

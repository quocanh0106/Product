<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\Product\Model\Product;

use AHT\Product\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Framework\App\ObjectManager;
use AHT\Product\Model\Product\FileInfo;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;
    private $fileInfo;
    protected $_storeManager;   
    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->_storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    public function convertValues($banner)
    {
        $fileName = $banner->getImages();
        $image = [];
        if ($this->getFileInfo()->isExist($fileName)) {
            $stat = $this->getFileInfo()->getStat($fileName);
            $mime = $this->getFileInfo()->getMimeType($fileName);
            $image[0]['name'] = $fileName;
            $image[0]['url'] = $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                )."product/index/".$fileName;
            $image[0]['size'] = isset($stat) ? $stat['size'] : 0;
            $image[0]['type'] = $mime;
        }
        $banner->setImage($image);
        return $banner;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {  
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        /* @var \Magento\Cms\Model\Block $block */
        foreach ($items as $banner) {
            if ($banner->getDefaultImage()) {
                $img['path'][0]['name'] = $banner->getDefaultImage();
                $img['path'][0]['url'] = $this->getMediaUrl()."/".$banner->getDefaultImage();
                $fullData = $banner->getData();
                $this->_loadedData[$banner->getId()] = array_merge($fullData, $img);
            }
            else{
                $banner = $this->convertValues($banner);
                $this->loadedData[$banner->getId()] = $banner->getData();
            }
        }

        $data = $this->dataPersistor->get('index');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('index');
        }

        return $this->loadedData;
    }
    private function getFileInfo()
    {
        if ($this->fileInfo === null) {
            $this->fileInfo = ObjectManager::getInstance()->get(FileInfo::class);
        }
        return $this->fileInfo;
    }
}
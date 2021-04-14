<?php

namespace AHT\Product\Block\Frontend\Product;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use AHT\Product\Model\ResourceModel\Product\Grid\CollectionFactory;

class Detail extends Template
{
    protected $_pageFactory;
    protected $_coreRegistry;
    protected $_productCollectionFactory;
    public $_storeManager;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Registry $coreRegistry,
        CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_productCollectionFactory = $productCollectionFactory;
        return parent::__construct($context, $data);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }

    public function getEditRecord()
    {
        $id = $this->_coreRegistry->registry('editRecordId');
        $data = $this->_productCollectionFactory->create();
        $result = $data->addFieldToFilter('id', $id);
        $product = $result->getData();
        return $product[0];
    }
}

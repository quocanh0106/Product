<?php

/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\Product\Controller\Adminhtml\Category;

use AHT\Product\Helper\Data;
use Magento\Framework\App\Action\HttpPostActionInterface;
use AHT\Product\Api\ProductRepositoryInterface;
use AHT\Product\Model\Product;
use AHT\Product\Model\ProductFactory;
use AHT\Product\Api\CategoryRepositoryInterface;
use AHT\Product\Model\Category;
use AHT\Product\Model\CategoryFactory;

class Delete extends \AHT\Product\Controller\Adminhtml\Category implements HttpPostActionInterface
{
    protected $_helper;
    protected $_coreRegistry;
    protected $_productFactory;
    protected $_productRepository;
    protected $_categoryFactory;
    protected $_categoryRepository;
    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ProductFactory|null $productFactory
     * @param ProductRepositoryInterface|null $productRepository
     * @param CategoryFactory|null $categoryFactory
     * @param CategoryRepositoryInterface|null $categoryRepository
     */

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, Data $helper, ProductFactory $productFactory = null, ProductRepositoryInterface $productRepository = null, CategoryFactory $categoryFactory = null, CategoryRepositoryInterface $categoryRepository = null)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $coreRegistry);
        $this->_helper = $helper;
        $this->_productFactory = $productFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(ProductFactory::class);
        $this->_productRepository = $productRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(ProductRepositoryInterface::class);
        $this->_categoryFactory = $categoryFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(categoryFactory::class);
        $this->_categoryRepository = $categoryRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(categoryRepositoryInterface::class);
    }
    /**
     * Delete action`
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        $items = $this->_helper->getProductByCate($id);
        // die();
        if ($id) {
            try {
                // init model and delete
                // $model = $this->_productFactory->create()->getData();
                $model = $this->_categoryFactory->create();
                $model->load($id);
                foreach($items as $value){
                    $this->_productRepository->deleteById($value['id']);
                }
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Category.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());

                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Category to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

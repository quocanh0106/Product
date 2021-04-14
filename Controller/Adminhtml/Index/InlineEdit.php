<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Product\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use AHT\Product\Api\ProductRepositoryInterface as ProductRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use AHT\Product\Api\Data\ProductInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'AHT_Product::product';

    /**
     * @var \AHT\Product\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param ProductRepository $productRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        ProductRepository $productRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->productRepository = $productRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $productId) {
                    /** @var \AHT\Product\Model\Product $product */
                    $product = $this->productRepository->getById($productId);
                    try {
                        $product->setData(array_merge($product->getData(), $postItems[$productId]));
                        $this->productRepository->save($product);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithProductId(
                            $product,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param ProductInterface $product
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithProductId(ProductInterface $product, $errorText)
    {
        return '[Product ID: ' . $product->getId() . '] ' . $errorText;
    }
}
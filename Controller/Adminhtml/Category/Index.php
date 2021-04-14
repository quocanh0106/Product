<?php

/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\Product\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;


    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        // $resultPage->setActiveMenu('AHT_Product:product');
        // $resultPage->addBreadcrumb(__('Category'), __('Category'));
        // $resultPage->addBreadcrumb(__('Manage Category'), __('Manage Category'));
        $resultPage->getConfig()->getTitle()->prepend(__('Category'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AHT_Category::index');
    }
}

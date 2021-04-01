<?php 

namespace AHT\Product\Controller\Adminhtml\Index;

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
        // $resultPage->addBreadcrumb(__('Product'), __('Product'));
        // $resultPage->addBreadcrumb(__('Manage Product'), __('Manage Product'));
        $resultPage->getConfig()->getTitle()->prepend(__('Product'));
        return $resultPage;
    } 

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AHT_Product::index');
    }

}
<?php
namespace AHT\Product\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $_postFactory;

    public function __construct(\AHT\Product\Model\ProductFactory $postFactory)
    {
        $this->_postFactory = $postFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $data = [
            'name' => "blazer", 
            'images' => "blazer.jpg",
            'description' => "blazer is great clothes"
        ];
        $post = $this->_postFactory->create();
        $post->addData($data)->save();
    }
}
?>
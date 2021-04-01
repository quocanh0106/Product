<?php

namespace AHT\Product\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
	protected $_postFactory;

	public function __construct(\AHT\Product\Model\ProductFactory $postFactory)
	{
		$this->_postFactory = $postFactory;
	}

	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		if (version_compare($context->getVersion(), '1.0.2', '<')) {
			$data = [
				'title' => "Product 2", 
				'images' => "test.jpg Upgrade Data",
				'description' => "Product 2"
			];
			$post = $this->_postFactory->create();
			$post->addData($data)->save();
		}

		$setup->startSetup();
	}
}

<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\Product\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {   
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('aht_product'),
                'price',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 20,
                    'nullable' => false,
                    'default' => '',
                    'comment' => 'Price'
                ]

            );
        } 
       
        $setup->endSetup();
    }

}
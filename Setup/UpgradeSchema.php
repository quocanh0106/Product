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
        };
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $setup->getConnection()->changeColumn(
                $setup->getTable('aht_category'),
                'name',
                'name_cate',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 100,
                    'nullable' => true,
                    'default' => '',
                    'comment' => 'Category Name'
                ]
            );
        }
        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('aht_product'),
                'is_new',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                    'length' => 1,
                    'nullable' => false,
                    'default' => '1',
                    'comment' => 'Active to show'
                ]

            );
        };
        $setup->endSetup();
    }
}

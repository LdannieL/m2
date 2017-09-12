<?php
namespace TWS\Favorites\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('tws_favorites_favorites')
        )->addColumn(
            'tws_favorites_favorites_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 
                'unsigned'  => true,
                'nullable'  => false,
                'length'    => 11,
             ],
            'Customer Id'
        )->addColumn(
            'product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 
                'unsigned'  => true,
                'nullable'  => false,
                'length'    => 11,
             ],
            'Product Id'
        )->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 
                'unsigned'  => true,
                'nullable'  => false,
                'length'    => 11,
             ],
            'Store Id'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        )
        // ->addForeignKey(
        //     $installer->getFkName('tws_favorites_favorites', 'customer_id', 'customer_entity', 'entity_id'),
        //     'customer_id',
        //     $installer->getTable('customer_entity'),
        //     'entity_id',
        //     \Magento\Framework\DB\Ddl\Table::ACTION_SET_NULL
        // )->addForeignKey(
        //     $installer->getFkName('tws_favorites_favorites', 'product_id', 'product_entity', 'entity_id'),
        //     'product_id',
        //     $installer->getTable('product_entity'),
        //     'entity_id',
        //     \Magento\Framework\DB\Ddl\Table::ACTION_SET_NULL
        // )->addForeignKey(
        //     $installer->getFkName('tws_favorites_favorites', 'store_id', 'core_store', 'entity_id'),
        //     'store_id',
        //     $installer->getTable('core_store'),
        //     'entity_id',
        //     \Magento\Framework\DB\Ddl\Table::ACTION_SET_NULL
        // )
        ;
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}

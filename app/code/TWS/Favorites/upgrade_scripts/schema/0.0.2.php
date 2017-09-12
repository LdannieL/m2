<?php 
/**
 * This script `included` via class method, inherits this variable from that context
 * @var $setup \Magento\Framework\Setup\SchemaSetupInterface
 */
 $setup;

/**
 * This script `included` via class method, inherits this variable from that context
 * @var $setup \Magento\Framework\Setup\ModuleContextInterface
 */
 $context;
 
//create a table
//         $table = $setup->getConnection()
//             ->newTable($setup->getTable(Gallery::GALLERY_VALUE_TO_ENTITY_TABLE))
//             ->addColumn(
//                 'value_id',
//                 \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
//                 null,
//                 ['unsigned' => true, 'nullable' => false],
//                 'Value media Entry ID'
//             )
//         $setup->getConnection()->createTable($table);

//update a table
$installer = $setup;
$tableFavorites = $setup->getTable('tws_favorites_favorites');

$setup->getConnection()->addForeignKey(
            $installer->getFkName(
                'tws_favorites_favorites',
                'customer_id',
                'customer_entity',
                'entity_id'
            ),
            $installer->getTable('tws_favorites_favorites'), 'customer_id', $installer->getTable('customer_entity'), 'entity_id',
            \Magento\Framework\Db\Ddl\Table::ACTION_CASCADE);

//lib\internal\Magento\Framework\DB\Adapter\Pdo\Mysql.php
    // public function addForeignKey(
    //     $fkName,
    //     $tableName,
    //     $columnName,
    //     $refTableName,
    //     $refColumnName,
    //     $onDelete = AdapterInterface::FK_ACTION_CASCADE,
    //     $purge = false,
    //     $schemaName = null,
    //     $refSchemaName = null
    // ) {
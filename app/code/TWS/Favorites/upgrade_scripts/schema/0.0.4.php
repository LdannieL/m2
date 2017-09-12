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
// $installer = $setup;
// $tableAdmins = $setup->getTable('admin_user');
// 
// $setup->getConnection()->addColumn(
//     $tableAdmins,
//     'failures_num',
//     [
//         'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
//         'nullable' => true,
//         'default' => 0,
//         'comment' => 'Failure Number'
//     ]
// );
$installer = $setup;
$tableFavorites = $setup->getTable('tws_favorites_favorites');

$setup->getConnection()->addForeignKey(
            $installer->getFkName(
                'tws_favorites_favorites',
                'product_id',
                'catalog_product_entity',
                'entity_id'
            ),
            $installer->getTable('tws_favorites_favorites'), 'product_id', $installer->getTable('catalog_product_entity'), 'entity_id',
            \Magento\Framework\Db\Ddl\Table::ACTION_CASCADE);

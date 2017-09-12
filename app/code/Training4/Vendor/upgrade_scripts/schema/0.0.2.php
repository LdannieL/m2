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
        $table = $setup->getConnection()
            ->newTable($setup->getTable('training4_vendor2product'))
            ->addColumn(
                'value_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true,],
                'Value media Entry ID'
            )->addColumn(
	            'vendor_id',
	            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
	            null,
	            ['nullable' => false, 'unsigned' => true, ],
	            'Vendor ID'
            )->addColumn(
	            'product_id',
	            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
	            null,
	            ['nullable' => false, 'unsigned' => true, ],
	            'Product ID'
	        );
        $setup->getConnection()->createTable($table);

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
 
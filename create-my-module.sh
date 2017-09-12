Package Name? (Pulsestorm)] Module Name? (Helloworld)] One Word Model Name? (Thing)] 
#!/bin/bash
php pestle.phar magento2:generate:module Training4 Vendor 0.0.1
php pestle.phar generate_crud_model Training4_Vendor Vendor
php pestle.phar magento2:generate:acl Pulsestorm_Helloworld Pulsestorm_Helloworld::things
php pestle.phar magento2:generate:menu Pulsestorm_Helloworld "" Pulsestorm_Helloworld::things Pulsestorm_Helloworld::things "Helloworld things" pulsestorm_helloworld_things/index/index 10
php pestle.phar magento2:generate:menu Pulsestorm_Helloworld Pulsestorm_Helloworld::things Pulsestorm_Helloworld::things_list Pulsestorm_Helloworld::things "Thing Objects" pulsestorm_helloworld_things/index/index 10
php pestle.phar generate_route Pulsestorm_Helloworld adminhtml pulsestorm_helloworld_things    
php pestle.phar generate_view Pulsestorm_Helloworld adminhtml pulsestorm_helloworld_things_index_index Main content.phtml 1column
php pestle.phar magento2:generate:ui:grid Pulsestorm_Helloworld pulsestorm_helloworld_things 'Pulsestorm\Helloworld\Model\ResourceModel\Thing\Collection' pulsestorm_helloworld_thing_id
php pestle.phar magento2:generate:ui:form Pulsestorm_Helloworld 'Pulsestorm\Helloworld\Model\Thing' Pulsestorm_Helloworld::things

php pestle.phar magento2:generate:ui:add_to_layout app/code/Pulsestorm/Helloworld/view/adminhtml/layout/pulsestorm_helloworld_things_index_index.xml content pulsestorm_helloworld_things
php pestle.phar magento2:generate:acl:change_title app/code/Pulsestorm/Helloworld/etc/acl.xml Pulsestorm_Helloworld::things "Manage things"
php pestle.phar magento2:generate:controller_edit_acl app/code/Pulsestorm/Helloworld/Controller/Adminhtml/Index/Index.php Pulsestorm_Helloworld::things

php pestle.phar magento2:generate:remove-named-node app/code/Pulsestorm/Helloworld/view/adminhtml/layout/pulsestorm_helloworld_things_index_index.xml block pulsestorm_helloworld_block_main

php bin/magento module:enable Training4_Vendor
php bin/magento setup:upgrade


Training4_Vendor
<?php

namespace Training\WorkingWithDatabases\Setup\Service;

use Magento\Framework\DB\Ddl\Table as TableDdl;
use Magento\Framework\Setup\SchemaSetupInterface;
use Training\WorkingWithDatabases\Setup\TodoSchemaInterface;
use Zend_Db_Exception;

class InstallTodoSchemaService
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     *
     * @return void
     * @throws Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $setup)
    {
        $setup->startSetup();

        $todoTableName = $setup->getTable(TodoSchemaInterface::TABLE_TODO);

        if ($setup->tableExists($todoTableName)) {
            return;
        }

        $resourceConnection = $setup->getConnection();

        $todoTable = $resourceConnection->newTable($todoTableName);

        $todoTable->addColumn(
            'todo_id',
            TableDdl::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Todo Id'
        );
        $todoTable->addColumn(
            'updated_at',
            TableDdl::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => TableDdl::TIMESTAMP_INIT_UPDATE],
            'Todo Updated at Time'
        );
        $todoTable->addColumn(
            'message',
            TableDdl::TYPE_TEXT,
            1024,
            ['nullable' => false],
            'Todo Message'
        );
        $todoTable->addColumn(
            'status',
            TableDdl::TYPE_SMALLINT,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Todo Status'
        );

        $resourceConnection->createTable($todoTable);

        $setup->endSetup();
    }
}
<?php

namespace Training\WorkingWithDatabases\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Training\WorkingWithDatabases\Setup\Service\InstallTodoSchemaService;

/**
 * Class InstallSchema
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var InstallTodoSchemaService
     */
    protected $installTodoSchemaService;

    /**
     * @param InstallTodoSchemaService $installTodoSchemaService
     */
    public function __construct(
        InstallTodoSchemaService $installTodoSchemaService
    ) {
        $this->installTodoSchemaService = $installTodoSchemaService;
    }

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->installTodoSchemaService->execute($setup);
    }
}
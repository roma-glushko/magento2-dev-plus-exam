<?php

namespace Training\WorkingWithDatabases\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Training\WorkingWithDatabases\Setup\TodoSchemaInterface;

class TodoResource extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TodoSchemaInterface::TABLE_TODO, 'todo_id');
    }
}
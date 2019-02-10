<?php

namespace Training\WorkingWithDatabases\Model\ResourceModel\Todo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\WorkingWithDatabases\Model\TodoModel;
use Training\WorkingWithDatabases\Model\ResourceModel\TodoResource;

class TodoCollection extends AbstractCollection
{
    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix = 'todo_collection';

    /**
     * Name of event parameter
     *
     * @var string
     */
    protected $_eventObject = 'todo_collection';

    /**
     * Initialize collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TodoModel::class, TodoResource::class);
    }
}
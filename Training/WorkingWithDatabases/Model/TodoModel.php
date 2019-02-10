<?php

namespace Training\WorkingWithDatabases\Model;

use Magento\Framework\Model\AbstractModel;
use Training\WorkingWithDatabases\Model\ResourceModel\TodoResource;

class TodoModel extends AbstractModel
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'todo_model';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'todo_model';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * When you use true - all cache will be clean
     *
     * @var string|array|bool
     */
    protected $_cacheTag = 'todo_cache';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TodoResource::class);
    }
}

<?php

namespace Training\WorkingWithDatabases\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Training\WorkingWithDatabases\Api\Data\TodoInterface;

class TodoData extends AbstractExtensibleObject implements TodoInterface
{
    /**
     * @var int
     */
    protected $todoId;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $status;

    /**
     * Retrieve TodoID
     *
     * @return int
     */
    public function getTodoId(): int
    {
        return $this->todoId;
    }

    /**
     * Set TodoID
     *
     * @param int $todoId
     * @return void
     */
    public function setTodoId(int $todoId): void
    {
        $this->todoId = $todoId;
    }

    /**
     * Retrieve UpdatedAt time
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return void
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Training\WorkingWithDatabases\Api\Data\TodoExtensionInterface
     */
    public function getExtensionAttributes()
    {
        if (!$this->_getExtensionAttributes()) {
            /** @var \Training\WorkingWithDatabases\Api\Data\TodoExtensionInterface $extensionAttributes */
            $extensionAttributes = $this->extensionFactory->create(self::class);

            $this->setExtensionAttributes($extensionAttributes);
        }

        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     *
     * @param \Training\WorkingWithDatabases\Api\Data\TodoExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(
        \Training\WorkingWithDatabases\Api\Data\TodoExtensionInterface $extensionAttributes
    ): void {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

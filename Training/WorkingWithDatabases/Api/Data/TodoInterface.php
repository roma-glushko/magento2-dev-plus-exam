<?php

namespace Training\WorkingWithDatabases\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Extensible TodoInterface
 */
interface TodoInterface extends ExtensibleDataInterface
{
    /**
     * Retrieve TodoID
     *
     * @return int
     */
    public function getTodoId(): int;

    /**
     * Set TodoID
     *
     * @param int $todoId
     * @return void
     */
    public function setTodoId(int $todoId): void;

    /**
     * Retrieve UpdatedAt time
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * @param string $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void;

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @param string $message
     *
     * @return void
     */
    public function setMessage(string $message): void;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int $status
     *
     * @return void
     */
    public function setStatus(int $status): void;

    /**
     * Retrieve extensible attributes
     *
     * @return \Training\WorkingWithDatabases\Api\Data\TodoExtensionInterface
     */
    public function getExtensionAttributes();

    /**
     * Set extensible attributes
     *
     * @param \Training\WorkingWithDatabases\Api\Data\TodoExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(
        \Magento\CatalogInventory\Api\Data\TodoExtensionInterface $extensionAttributes
    ): void;
}
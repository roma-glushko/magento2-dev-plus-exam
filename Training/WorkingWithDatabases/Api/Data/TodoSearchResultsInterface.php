<?php

namespace Training\WorkingWithDatabases\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 */
interface TodoSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Gets collection of case entities.
     *
     * @return \Training\WorkingWithDatabases\Api\Data\TodoInterface[]
     */
    public function getItems();

    /**
     * Sets collection of case entities.
     *
     * @param \Training\WorkingWithDatabases\Api\Data\TodoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
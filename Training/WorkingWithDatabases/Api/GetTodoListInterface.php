<?php

namespace Training\WorkingWithDatabases\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 */
interface GetTodoListInterface
{
    /**
     * Gets list of ToDo entities
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\WorkingWithDatabases\Api\Data\TodoSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
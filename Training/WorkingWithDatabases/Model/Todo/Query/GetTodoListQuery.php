<?php

namespace Training\WorkingWithDatabases\Model\Todo\Query;

use Magento\Framework\Api\SearchCriteriaInterface;
use Training\WorkingWithDatabases\Api\Data\TodoSearchResultsInterface;
use Training\WorkingWithDatabases\Api\Data\TodoSearchResultsInterfaceFactory;
use Training\WorkingWithDatabases\Api\GetTodoListInterface;
use Training\WorkingWithDatabases\Model\ResourceModel\Todo\TodoCollection;
use Training\WorkingWithDatabases\Model\ResourceModel\Todo\TodoCollectionFactory;

class GetTodoListQuery implements GetTodoListInterface
{
    /**
     * @var TodoCollectionFactory
     */
    private $todoCollectionFactory;

    /**
     * @var TodoSearchResultsInterfaceFactory
     */
    private $todoSearchResultsFactory;

    /**
     * @param TodoCollectionFactory $todoCollectionFactory
     * @param TodoSearchResultsInterfaceFactory $todoSearchResultsFactory
     */
    public function __construct(
        TodoCollectionFactory $todoCollectionFactory,
        TodoSearchResultsInterfaceFactory $todoSearchResultsFactory
    ) {
        $this->todoCollectionFactory = $todoCollectionFactory;
        $this->todoSearchResultsFactory = $todoSearchResultsFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var TodoCollection $todoCollection */
        $todoCollection = $this->todoCollectionFactory->create();

        /** @var TodoSearchResultsInterface $searchResults */
        $searchResults = $this->todoSearchResultsFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($todoCollection->getItems());

        return $searchResults;
    }
}
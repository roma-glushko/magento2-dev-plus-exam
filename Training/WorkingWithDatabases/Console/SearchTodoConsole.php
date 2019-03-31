<?php

namespace Training\WorkingWithDatabases\Console;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Training\WorkingWithDatabases\Api\GetTodoListInterface;

class SearchTodoConsole extends ConsoleCommand
{
    /**
     * @var GetTodoListInterface
     */
    protected $getTodoList;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param GetTodoListInterface $getTodoList
     * @param string|null $name
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        GetTodoListInterface $getTodoList,
        string $name = null
    ) {
        parent::__construct($name);

        $this->getTodoList = $getTodoList;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('training:working-with-databases:search-todo');
        $this->setDescription('Search Todo records');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $messagePattern = 'milk';

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('message', $messagePattern, 'like')
            ->create();

        $searchResults = $this->getTodoList->getList($searchCriteria);

        foreach ($searchResults->getItems() as $todoItem) {
            $output->writeln($todoItem->getMessage());
        }
    }
}
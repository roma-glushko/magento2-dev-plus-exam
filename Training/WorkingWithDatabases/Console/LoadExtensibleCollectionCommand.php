<?php

namespace Training\WorkingWithDatabases\Console;

use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Customer\Model\ResourceModel\CustomerRepository\Proxy;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Training\WorkingWithDatabases\Model\ExtensibleTodoModelFactory;
use Training\WorkingWithDatabases\Model\TodoModelFactory;

class LoadExtensibleCollectionCommand extends ConsoleCommand
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Proxy $customerRepository
     * @param string|null $name
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CustomerRepository\Proxy $customerRepository,
        string $name = null
    ) {
        parent::__construct($name);

        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('training:working-with-databases:load-extensible-collection');
        $this->setDescription('Load extensible collection');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $customerSearchResult = $this->customerRepository->getList($searchCriteria);

        $output->writeln(sprintf('Customer Count: %s', $customerSearchResult->getTotalCount()));
    }
}
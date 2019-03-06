<?php

namespace Training\WorkingWithDatabases\Console;

use Exception;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Training\WorkingWithDatabases\Api\Data\TodoInterface;
use Training\WorkingWithDatabases\Api\Data\TodoInterfaceFactory;
use Training\WorkingWithDatabases\Model\TodoModel;
use Training\WorkingWithDatabases\Model\ExtensibleTodoModel;
use Training\WorkingWithDatabases\Model\ExtensibleTodoModelFactory;
use Training\WorkingWithDatabases\Model\TodoModelFactory;
use Training\WorkingWithDatabases\Model\ResourceModel\TodoResource;

class AddTodoCommand extends ConsoleCommand
{
    /**
     * @var TodoResource
     */
    protected $todoResource;

    /**
     * @var TodoModelFactory
     */
    protected $todoModelFactory;

    /**
     * @var ExtensibleTodoModelFactory
     */
    protected $todoExtensibleModelFactory;

    /**
     * @var TodoInterfaceFactory
     */
    protected $todoFactory;

    /**
     * @param TodoModelFactory $todoModelFactory
     * @param TodoResource $todoResource
     * @param TodoInterfaceFactory $todoFactory
     * @param string|null $name
     */
    public function __construct(
        TodoModelFactory $todoModelFactory,
        TodoResource $todoResource,
        TodoInterfaceFactory $todoFactory,
        string $name = null
    ) {
        parent::__construct($name);

        $this->todoResource = $todoResource;
        $this->todoModelFactory = $todoModelFactory;
        $this->todoFactory = $todoFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('training:working-with-databases:add-todo');
        $this->setDescription('Add Todo record to DB');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        /**
         * Old school DB operations
         *
         * Persistence layer (Model-ResourceModel-Collection) is used directly for CRUD
         */

        try {
            /** @var TodoModel $todoModel */
            $todoModel = $this->todoModelFactory->create();

            $todoModel->addData([
                'message' => 'Need to buy some milk',
            ]);

            $this->todoResource->save($todoModel);

            if ($todoModel->getId()) {
                $output->writeln(sprintf('Todo has been saved (ID: #%s)', $todoModel->getId()));
            }

            /** @var TodoInterface $todoData */
            $todoData = $this->todoFactory->create();

            $todoData->setMessage('Need to buy some extensible milk');

            // todo: use extensible attributes of ExtensibleTodoModel
            $extensibleAttributes = $todoData->getExtensionAttributes();


        } catch (Exception $exception) {
            $output->writeln($exception->getMessage());
        }
    }
}
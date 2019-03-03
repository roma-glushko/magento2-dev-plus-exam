<?php

namespace Training\WorkingWithDatabases\Console;

use Exception;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
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
     * @param ExtensibleTodoModelFactory $todoExtensibleModelFactory
     * @param TodoModelFactory $todoModelFactory
     * @param TodoResource $todoResource
     * @param string|null $name
     */
    public function __construct(
        ExtensibleTodoModelFactory $todoExtensibleModelFactory,
        TodoModelFactory $todoModelFactory,
        TodoResource $todoResource,
        string $name = null
    ) {
        parent::__construct($name);

        $this->todoResource = $todoResource;
        $this->todoModelFactory = $todoModelFactory;
        $this->todoExtensibleModelFactory = $todoExtensibleModelFactory;
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

            /**
             * @var ExtensibleTodoModel $extensibleTask
             */
            $extensibleTask = $this->todoExtensibleModelFactory->create();

            $extensibleTask->addData([
                'message' => 'Need to buy some extensible milk',
            ]);

        } catch (Exception $exception) {
            $output->writeln($exception->getMessage());
        }
    }
}
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Console;

use Magento\Backend\App\Area\FrontNameResolver as BackendFrontNameResolver;
use Magento\Framework\App\AreaList;
use Magento\Framework\App\State as AppState;
use Magento\Framework\Console\Cli;
use Magento\Store\Model\StoreManagerInterface;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\ProgressBarFactory;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableFactory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AdvancedTrainingCommand extends ConsoleCommand
{
    /**
     * @var FormatterHelper
     */
    protected $formatterHelper;

    /**
     * @var TableFactory
     */
    protected $tableFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var ProgressBarFactory
     */
    protected $progressBarFactory;

    /**
     * @var AppState
     */
    protected $appState;

    /**
     * @var AreaList
     */
    protected $areaList;

    /**
     * @param StoreManagerInterface $storeManager
     * @param TableFactory $tableFactory
     * @param ProgressBarFactory $progressBarFactory
     * @param FormatterHelper $formatterHelper
     * @param AppState $appState
     * @param AreaList $areaList
     * @param null|string $name
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        TableFactory $tableFactory,
        ProgressBarFactory $progressBarFactory,
        FormatterHelper $formatterHelper,
        AppState $appState,
        AreaList $areaList,
        string $name = null
    ) {
        parent::__construct($name);

        $this->formatterHelper = $formatterHelper;
        $this->tableFactory = $tableFactory;
        $this->storeManager = $storeManager;
        $this->progressBarFactory = $progressBarFactory;
        $this->appState = $appState;
        $this->areaList = $areaList;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('training:advanced-training-cli');
        $this->setDescription('M2CPD+ Training Console Command');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Using advanced formatting
        $this->showAdvancedFormatting($output);

        // Using table
        $this->showTable($output);

        // Using progress bar
        $this->showProgressBar($output);

        // Changing area

//        $area = $this->areaList->getArea(BackendFrontNameResolver::AREA_CODE);
//        $area->load();

        // Emulating code in specific area

//        $this->appState->emulateAreaCode(
//            BackendFrontNameResolver::AREA_CODE,
//            [$this, 'someMethod'],
//            []
//        );

        return Cli::RETURN_SUCCESS;
    }

    /**
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function showAdvancedFormatting(OutputInterface $output)
    {
        $header = $this->formatterHelper->formatSection(
            'Magento2 Command Framework',
            'Magento 2 uses awesome Symfony Console component to power CLI commands.' . PHP_EOL .
            'In this command, we will test advanced abilities that Magento 2 has and extends from Symfony.'
        );
        $output->writeln($header);

        $commandInfoBlock = $this->formatterHelper->formatBlock(
            'Symfony helps to render structured list of data directly in CLI using tables:',
            'info'
        );
        $output->writeln($commandInfoBlock);
    }

    /**
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function showTable(OutputInterface $output)
    {
        /** @var Table $storeListTable */
        $storeListTable = $this->tableFactory->create(['output' => $output]);
        $storeList = $this->storeManager->getStores(true, true);

        $storeListTable->setHeaders(['ID', 'Website ID', 'Group ID', 'Name', 'Code', 'Sort Order', 'Is Active']);

        foreach ($storeList as $store) {
            $storeListTable->addRow([
                $store->getId(),
                $store->getWebsiteId(),
                $store->getStoreGroupId(),
                $store->getName(),
                $store->getCode(),
                $store->getData('sort_order'),
                $store->getData('is_active'),
            ]);
        }

        $storeListTable->render($output);
    }

    /**
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function showProgressBar(OutputInterface $output)
    {
        $count = 5;

        /** @var ProgressBar $progressBar */
        $progressBar = $this->progressBarFactory->create([
            'output' => $output,
            'max' => $count,
        ]);
        $progressBar->setFormat(
            '<info>%message%</info> %current%/%max% [%bar%] %percent:3s%% %elapsed% %memory:6s%'
        );
        $output->writeln('<info>Doing something was started.</info>');
        $progressBar->start();
        $progressBar->display();

        for ($i = 0; $i < $count; $i++) {
            $progressBar->setMessage('Executing something #' . $i . '...');
            $progressBar->display();
            sleep(2);
            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln('');
        $output->writeln('<info>Something has been done.</info>');
    }
}
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\MagentoArchitecture\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Training\MagentoArchitecture\Model\Config\Training\Data as TrainingConfigData;
use Training\MagentoArchitecture\Model\Config\Training\Data\Proxy as TrainingConfigDataProxy;

class TrainingCommand extends ConsoleCommand
{
    /**
     * @var TrainingConfigData|TrainingConfigDataProxy
     */
    protected $trainingConfigData;

    /**
     * @param TrainingConfigData $trainingConfigData
     * @param null|string $name
     */
    public function __construct(
        TrainingConfigDataProxy $trainingConfigData,
        string $name = null
    ) {
        parent::__construct($name);

        $this->trainingConfigData = $trainingConfigData;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('training:get-training-config')->setDescription('M2CPD+ Training Console Command');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump($this->trainingConfigData->get());
    }
}
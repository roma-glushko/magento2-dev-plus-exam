<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\MagentoArchitecture\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Magento\Framework\Config\Data as ConfigData;

class TrainingCommand extends ConsoleCommand
{
    /**
     * @var ConfigData
     */
    protected $trainingConfigReader;

    /**
     * @param ConfigData $trainingConfigReader
     * @param null|string $name
     */
    public function __construct(
        ConfigData $trainingConfigReader,
        string $name = null
    ) {
        parent::__construct($name);

        $this->trainingConfigReader = $trainingConfigReader;
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
        var_dump($this->trainingConfigReader->get());
    }
}
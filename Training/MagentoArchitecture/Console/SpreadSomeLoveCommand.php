<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Training\MagentoArchitecture\Model\Service\SpreadSomeLoveService;
use Training\MagentoArchitecture\Model\Service\SpreadSomeLoveService\Proxy as SpreadSomeLoveServiceProxy;

class SpreadSomeLoveCommand extends ConsoleCommand
{
    /**
     * @var SpreadSomeLoveService
     */
    protected $spreadSomeLoveService;

    /**
     * @param SpreadSomeLoveService $spreadSomeLoveService
     * @param null|string $name
     */
    public function __construct(
        SpreadSomeLoveServiceProxy $spreadSomeLoveService,
        string $name = null
    ) {
        parent::__construct($name);

        $this->spreadSomeLoveService = $spreadSomeLoveService;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('training:spread-some-love');
        $this->setDescription('M2CPD+ Plugin/Interceptor Practice Command');
        $this->addArgument('name', InputArgument::OPTIONAL, 'User Name', 'Roma');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userName = $input->getArgument('name');

        $output->writeln($this->spreadSomeLoveService->execute($userName));
    }
}
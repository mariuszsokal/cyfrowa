<?php

namespace App\Command;

use App\Logger\FileLogger;
use App\Bus\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

final class ActivateUserCommand extends Command
{
    private const ARG_USERID = 'userId';
    private CommandBus $commandBus;
    private FileLogger $logger;

    protected static $defaultName = 'cli:activate-user';

    public function __construct(
        CommandBus $commandBus,
        FileLogger $logger
    ) {
        $this->commandBus = $commandBus;
        $this->logger = $logger;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument(self::ARG_USERID, InputArgument::REQUIRED, 'UserId')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument(self::ARG_USERID);
        if(!$userId) {
            throw new \Exception('Missing userId');

            return Command::FAILURE;
        }

        $operationId = $this->logger->init();
        $this->logger->log(\Psr\Log\LogLevel::INFO, $operationId, 'CLI CMD app_user_active was triggered');

        $this->commandBus->handle(new \App\Application\Command\ActivateUserCommand($operationId, $userId));

        return Command::SUCCESS;
    }
}
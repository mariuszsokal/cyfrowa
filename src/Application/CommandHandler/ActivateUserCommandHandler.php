<?php
declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\CommandHandler\CommandHandlerInterface;
use App\Application\Command\ActivateUserCommand;
use App\Logger\FileLogger;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Event\UserActivateEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class ActivateUserCommandHandler implements CommandHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private EventDispatcherInterface $eventDispatcher;
    private FileLogger $logger;

    public function __construct(
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher,
        FileLogger $logger,
    ) {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    public function __invoke(ActivateUserCommand $command) {
        $this->logger->log(\Psr\Log\LogLevel::INFO, $command->getOperationId(), 'CommandHandler ActivateUserCommand was triggered');

        $userId = $command->getUserId();
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        if(!$user) {
            $this->logger->log(\Psr\Log\LogLevel::WARNING, $command->getOperationId(), sprintf('UserId %d not found', $userId));
            throw new \Exception('User not found');
        }

        if($user->isActive()) {
            $this->logger->log(\Psr\Log\LogLevel::WARNING, $command->getOperationId(), sprintf('UserId %d is already active', $userId));
            throw new \Exception('User is already active');
        }


        $user->setActive(true);
        $this->entityManager->flush();

        $this->logger->log(\Psr\Log\LogLevel::INFO, $command->getOperationId(), sprintf('UserId %d has been activated', $userId));
        $this->eventDispatcher->dispatch(new UserActivateEvent());
    }
}
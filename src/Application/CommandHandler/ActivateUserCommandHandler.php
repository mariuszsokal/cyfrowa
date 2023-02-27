<?php
declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\CommandHandler\CommandHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

final class ActivateUserCommandHandler implements CommandHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ActivateUserCommand $command) {
        $userId = $command->getUserId();
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        if(!$user) {
            throw new \Exception('User not found');
        }

        if($user->isActive()) {
            throw new \Exception('User is already active');
        }

        $user->setActive(true);
        $this->entityManager->flush();
    }
}
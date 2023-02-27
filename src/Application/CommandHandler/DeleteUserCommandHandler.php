<?php
declare(strict_types=1);

namespace App\Application\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Application\CommandHandler\CommandHandlerInterface;
use App\Application\Command\DeleteUserCommand;

final class DeleteUserCommandHandler implements CommandHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function __invoke(DeleteUserCommand $command) {
        $userId = $command->getUserId();
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        if(!$user) {
            throw new \Exception('User not found');
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
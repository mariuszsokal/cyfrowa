<?php
declare(strict_types=1);

namespace App\Application\Validator;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

final class DeactivateUserCommandHandlerValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ActivateUserCommand $command) {
        $userId = $command->getUserId();
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        if(!$user) {
            //error
        }

        if(!$user->isActive()) {
            //error
        }
    }
}
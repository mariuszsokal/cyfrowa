<?php
declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\CommandHandler\CommandHandlerInterface;
use App\Application\Command\CreateUserCommand;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

final class CreateUserCommandHandler implements CommandHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function __invoke(CreateUserCommand $command) {
        $user = (new User())
            ->setUserName($command->getUserName())
            ->setEmail($command->getEmail())
            ->setCompanyName($command->getCompanyName())
            ->setVatId($command->getVatId());
            
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
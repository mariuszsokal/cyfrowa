<?php
declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\CommandHandler\CommandHandlerInterface;
use App\Application\Command\UpdateUserCommand;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

final class UpdateUserCommandHandler implements CommandHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function __invoke(UpdateUserCommand $command) {
        $userId = $command->getUserId();
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        if(!$user) {
            throw new \Exception('User not found');
        }
        
        if($userName = $command->getUserName()) {
            $user->setUserName($userName);
        }

        if($email = $command->getEmail()) {
            $user->setEmail($email);
        }

        if($companyName = $command->getCompanyName()) {
            $user->setCompanyName($companyName);
        }

        if($vatId = $command->getVatId()) {
            $user->setVatId($vatId);
        }
            
        $this->entityManager->flush();
    }
}
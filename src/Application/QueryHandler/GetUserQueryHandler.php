<?php
declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\QueryHandler\QueryHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

final class GetUserQueryHandler implements QueryHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function __invoke(GetUserQueryHandler $query) {
        $userId = $query->getUserId();
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        if(!$user) {
            throw new \Exception('User not found');
        }

        dump('in handler');

        // user data
    }
}
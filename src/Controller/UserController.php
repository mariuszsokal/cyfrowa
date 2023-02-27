<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Bus\QueryBus;
use App\Bus\CommandBus;
use App\Application\Query\GetUserQuery;
use App\Application\Command\ActivateUserCommand;
use App\Application\Command\DeactivateUserCommand;
use App\Application\Command\CreateUserCommand;
use App\Application\Command\UpdateUserCommand;
use App\Application\Command\DeleteUserCommand;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private QueryBus $queryBus;
    private CommandBus $commandBus;

    public function __construct(
        EntityManagerInterface $entityManager,
        QueryBus $queryBus,
        CommandBus $commandBus
    ) {
        $this->entityManager = $entityManager;
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/users/activate/{userId}", name="app_user_activate")
     */
    public function activate(int $userId): JsonResponse
    {
        $this->commandBus->handle(new ActivateUserCommand($userId));

        return new JsonResponse([]);
    }

    /**
     * @Route("/users/deactivate/{userId}", name="app_user_deactivate")
     */
    public function deactivate(int $userId): JsonResponse
    {
        $this->commandBus->handle(new DeactivateUserCommand($userId));

        return new JsonResponse([]);
    }
    
    /**
     * @Route("/users/create", name="app_user_create")
     */
    public function create(Request $request): JsonResponse
    {
        //$this->commandBus->handle(new CreateUserCommand());

        return new JsonResponse([]);
    }

    /**
     * @Route("/users/{userId}", name="app_user_get")
     */
    public function get(int $userId): JsonResponse
    {
        $user = $this->queryBus->handle(new GetUserQuery($userId));

        return new JsonResponse(json_encode($user));
    }

    /**
     * @Route("/users/update/{userId}", name="app_user_update")
     */
    public function update(int $userId): JsonResponse
    {
        
        //$this->commandBus->handle(new UpdateUserCommand());
        return new JsonResponse([]);
    }

    /**
     * @Route("/users/delete/{userId}", name="app_user_delete")
     */
    public function delete(int $userId): JsonResponse
    {
        $this->commandBus->handle(new DeleteUserCommand($userId));

        return new JsonResponse([]);
    }
}
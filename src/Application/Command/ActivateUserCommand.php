<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Command\CommandInterface;

final class ActivateUserCommand implements CommandInterface
{
    private string $operationId;
    private int $userId;

    public function __construct(
        string $operationId, 
        int $userId
    ) {
        $this->operationId = $operationId;
        $this->userId = $userId;
    }

    public function getOperationId(): string
    {
        return $this->operationId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
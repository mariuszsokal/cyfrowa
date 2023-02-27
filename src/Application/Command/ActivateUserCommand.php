<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Command\CommandInterface;

final class ActivateUserCommand implements CommandInterface
{
    private int $userId;

    public function __construct(int $userId) {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
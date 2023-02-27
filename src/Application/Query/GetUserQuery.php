<?php
declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Query\QueryInterface;

final class GetUserQuery implements QueryInterface
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
<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Command\CommandInterface;

final class CreateUserCommand implements CommandInterface
{
    private string $userName;
    private string $email;
    private string $companyName;
    private string $vatId;

    public function __construct(
        string $userName,
        string $email,
        string $companyName,
        string $vatId
    ) {
        $this->userName = $userName;
        $this->email = $email;
        $this->companyName = $companyName;
        $this->vatId = $vatId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getVatId(): string
    {
        return $this->vatId;
    }
}
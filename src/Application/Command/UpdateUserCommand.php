<?php
declare(strict_types=1);

namespace App\Application\Command;

final class UpdateUserCommand
{
    private int $userId;
    private ?string $userName;
    private ?string $email;
    private ?string $companyName;
    private ?string $vatId;
    private ?bool $active;

    public function __construct(
        int $userId,
        ?string $userName,
        ?string $email,
        ?string $companyName,
        ?string $vatId,
        ?bool $active
    ) {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->email = $email;
        $this->companyName = $companyName;
        $this->vatId = $vatId;
        $this->active = $active;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function getVatId(): ?string
    {
        return $this->vatId;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }
}
<?php

declare(strict_types=1);

namespace App\Component\User;

use Symfony\Component\Serializer\Annotation\Groups;

class UserFullNameDto
{
    public function __construct(
        #[Groups(['user:write', 'user:read'])]
        private string $givenName,

        #[Groups(['user:write', 'user:read'])]
        private string $familyName,

        #[Groups(['user:write', 'user:read'])]
        private int $age
    ) {
    }

    public function getGivenName(): string
    {
        return $this->givenName;
    }

    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}
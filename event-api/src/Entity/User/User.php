<?php

namespace App\Entity\User;

use App\Entity\Trait\IdentifierTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User
{
    use IdentifierTrait;

    #[ORM\Column(type: 'string')]
    private string $lastName;
    #[ORM\Column(type: 'string')]
    private string $firstName;
    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;
    #[ORM\Column(type: 'datetime')]
    private \DateTime $lastConectionAt;
    #[ORM\Column(type: 'string')]
    private string $password;
    #[ORM\Column(type: 'string')]
    private string $email;

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getLastConectionAt(): \DateTime
    {
        return $this->lastConectionAt;
    }

    public function setLastConectionAt(\DateTime $lastConectionAt): void
    {
        $this->lastConectionAt = $lastConectionAt;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

}
<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 */
class Usuario
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /** @ORM\Column(name="email", type="string") */
    private string $email;

    /** @ORM\Column(name="password", type="string") */
    private string $password;

    /** @ORM\Column(name="name", type="string") */
    private string $name;

    /** @ORM\Column(name="deleted_at", type="datetime") */
    private ?DateTime $deletedAt = null;

    private function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}

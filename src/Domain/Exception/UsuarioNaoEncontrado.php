<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use DomainException;

class UsuarioNaoEncontrado extends DomainException
{
    public static function fromEmail(string $email): self
    {
        return new self(sprintf('Usuario com o email "%s" não encontrado', $email));
    }

    public static function fromID(int $id): self
    {
        return new self(sprintf('Usuario com o id "%s" não encontrado', $id));
    }
}

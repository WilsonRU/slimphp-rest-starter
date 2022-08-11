<?php

declare(strict_types=1);

namespace App\Application\Auth\Exception;

use Exception;

class TokenNaoEncontradoException extends Exception
{
    public static function execute(): self
    {
        return new self('Token não encontrado');
    }
}

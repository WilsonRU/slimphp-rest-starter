<?php

declare(strict_types=1);

namespace App\Application\Auth;

use App\Application\Auth\Exception\TokenNaoEncontradoException;

class HeaderToken
{
    public static function get(): string
    {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        if ($authorization) {
            return str_replace('Bearer ', '', $authorization);
        }

        throw TokenNaoEncontradoException::execute();
    }
}

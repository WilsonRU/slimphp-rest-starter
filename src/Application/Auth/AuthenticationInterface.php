<?php

declare(strict_types=1);

namespace App\Application\Auth;

use App\Domain\Entity\Usuario;

interface AuthenticationInterface
{
    public function authenticate(string $inputToken): Usuario;

    public function generateToken(Usuario $user): string;
}

<?php

declare(strict_types=1);

namespace Test\Domain\Dto;

use App\Domain\Dto\BuscaUsuarioDto;
use PHPUnit\Framework\TestCase;

class BuscaUsuarioDtoTest extends TestCase
{
    /** @test */
    public function fromArrayDeveFuncionar(): void
    {
        $defaultParams = [
            'email'    => 'test@test.com',
            'password' => '1111',
        ];

        $buscaUsuario = BuscaUsuarioDto::fromArray($defaultParams);

        self::assertSame($defaultParams['email'], $buscaUsuario->getEmail());
        self::assertSame($defaultParams['password'], $buscaUsuario->getPassword());
    }
}

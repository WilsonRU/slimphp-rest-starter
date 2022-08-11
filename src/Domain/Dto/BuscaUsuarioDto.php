<?php

declare(strict_types=1);

namespace App\Domain\Dto;

use Assert\Assert;

class BuscaUsuarioDto
{
    private string $email;
    private string $password;

    public function __construct()
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function fromArray(array $params): self
    {
        self::validate($params);

        $instance = new self();

        $instance->email    = $params['email'];
        $instance->password = $params['password'];

        return $instance;
    }

    private static function validate(array $params): void
    {
        array_map(static function (string $key) use ($params) {
            Assert::that($params[$key])
                ->notNull("O campo '{$key}' deve ser enviado.")
                ->string("O campo '{$key}' precisa ser string.");
        }, ['email', 'password']);
    }
}

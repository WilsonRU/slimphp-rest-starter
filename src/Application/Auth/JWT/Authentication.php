<?php

declare(strict_types=1);

namespace App\Application\Auth\JWT;

use App\Application\Auth\AuthenticationInterface;
use App\Application\Auth\Exception;
use App\Domain\Entity\Usuario;
use App\Domain\Repository\UsuarioRepositoryInterface;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Validation\Constraint\SignedWith;

class Authentication implements AuthenticationInterface
{
    private Configuration $config;
    private UsuarioRepositoryInterface $userRepository;

    public function __construct(
        Configuration $config,
        UsuarioRepositoryInterface $userRepository
    ) {
        $this->config         = $config;
        $this->userRepository = $userRepository;
    }

    public function generateToken(Usuario $user): string
    {
        return $this->config->builder()
            ->issuedBy('blog')
            ->identifiedBy((string) $user->getId())
            ->permittedFor('blog')
            ->getToken($this->config->signer(), $this->config->signingKey())
            ->toString();
    }

    public function authenticate(string $inputToken): Usuario
    {
        if (empty($inputToken)) {
            throw Exception\TokenNaoEncontradoException::execute();
        }

        try {
            $token = $this->config->parser()->parse($inputToken);

            $this->config->setValidationConstraints(
                new SignedWith($this->config->signer(), $this->config->signingKey())
            );

            if (! $this->config->validator()->validate($token, ...$this->config->validationConstraints())) {
                throw Exception\TokenInvalidoException::execute();
            }

            assert($token instanceof Token\Plain);

            $userId = (int) $token->claims()->get('jti');

            return $this->userRepository->getById($userId);
        } catch (\Exception $e) {
            throw Exception\TokenInvalidoException::execute();
        }
    }
}

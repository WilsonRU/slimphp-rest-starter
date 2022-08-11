<?php

declare(strict_types=1);

namespace App\Application\Rest;

use App\Application\Auth\AuthenticationInterface;
use App\Domain\Dto\BuscaUsuarioDto;
use App\Domain\Repository\UsuarioRepositoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginAction
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array) $request->getParsedBody();

        $usuario = BuscaUsuarioDto::fromArray($params);

       /** @var UsuarioRepositoryInterface $usuarioRepository */
        $usuarioRepository = $this->container->get(UsuarioRepositoryInterface::class);
        $user              = $usuarioRepository->getUsuarioByDto($usuario);

        /** @var AuthenticationInterface $authentication */
        $authentication = $this->container->get(AuthenticationInterface::class);
        $token          = $authentication->generateToken($user);

        $response->getBody()->write(json_encode([
            'status_code' => 200,
            'token'       => $token,
            'message'     => 'Login realizado com sucesso',
        ], JSON_THROW_ON_ERROR));
        return $response
            ->withStatus(200);
    }
}

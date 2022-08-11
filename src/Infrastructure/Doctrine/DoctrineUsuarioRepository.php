<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\Dto\BuscaUsuarioDto;
use App\Domain\Entity\Usuario;
use App\Domain\Exception\UsuarioNaoEncontrado;
use App\Domain\Repository\UsuarioRepositoryInterface;
use Doctrine\ORM\EntityManager;

class DoctrineUsuarioRepository implements UsuarioRepositoryInterface
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function store(Usuario $usuario): void
    {
        $this->entityManager->persist($usuario);
        $this->entityManager->flush();
    }

    public function getById(int $id): Usuario
    {
        $result = $this->entityManager->getRepository(Usuario::class)->find($id);

        if ($result instanceof Usuario) {
            return $result;
        }

        throw UsuarioNaoEncontrado::fromID($id);
    }

    public function getUsuarioByDto(BuscaUsuarioDto $buscaUsuarioDto): Usuario
    {
        $result = $this->entityManager->getRepository(Usuario::class)->findOneBy([
            'email'    => $buscaUsuarioDto->getEmail(),
            'password' => $buscaUsuarioDto->getPassword(),
        ]);

        if ($result instanceof Usuario) {
            return $result;
        }

        throw UsuarioNaoEncontrado::fromEmail($buscaUsuarioDto->getEmail());
    }
}

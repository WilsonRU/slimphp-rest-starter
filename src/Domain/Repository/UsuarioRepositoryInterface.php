<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Dto\BuscaUsuarioDto;
use App\Domain\Entity\Usuario;

interface UsuarioRepositoryInterface
{
    public function store(Usuario $usuario): void;

    public function getById(int $id): Usuario;

    public function getUsuarioByDto(BuscaUsuarioDto $buscaUsuarioDto): Usuario;
}

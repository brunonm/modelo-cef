<?php
declare(strict_types=1);

namespace App\Service\Query;

use App\Repository\AgenciaRepository;

class AgenciaQuery
{
    /**
     * @var AgenciaRepository
     */
    private $agenciaRepository;

    public function __construct(AgenciaRepository $agenciaRepository)
    {
        $this->agenciaRepository = $agenciaRepository;
    }

    public function listar(): array
    {
        return $this->agenciaRepository->findAll();
    }
}

<?php
declare (strict_types = 1);

namespace App\Service\Command;

use App\Repository\AgenciaRepository;
use App\Entity\Agencia;

class RegistrarAgenciaHandler implements HandlerInterface
{
    /**
     * @var AgenciaRepository
     */
    private $agenciaRepository;

    public function __construct(AgenciaRepository $agenciaRepository)
    {
        $this->agenciaRepository = $agenciaRepository;
    }

    public function handle(RegistrarAgenciaCommand $command)
    {
        $agencia = new Agencia(
            $command->getId(), 
            $command->getCgc(), 
            $command->getNome()
        );

        $this->agenciaRepository->save($agencia);
    }
}

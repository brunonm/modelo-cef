<?php
declare (strict_types = 1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Agencia;

class AgenciaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Agencia::class);
    }

    public function save(Agencia $agencia)
    {
        $this->_em->persist($agencia);
    }
}

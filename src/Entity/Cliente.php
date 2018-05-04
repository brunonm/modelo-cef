<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="guid")
     * 
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    private $cpf;

    /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    private $nome;

    /**
     * @var Conta[]|array
     */
    private $contas = [];

    public function __construct(string $id, string $cpf, string $nome)
    {
        $this->id = $id;
        $this->cpf = $cpf;
        $this->nome = $nome;
    }
}

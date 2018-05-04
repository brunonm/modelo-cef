<?php
declare(strict_types=1);

namespace App\Service\Command;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrarAgenciaCommand
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    private $id;

    /**
     * @Assert\Length(
     *   min = 4,
     *   max = 4
     * )
     * @var string
     */
    private $cgc;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    private $nome;

    public function __construct(string $id, string $cgc, string $nome)
    {
        $this->id = $id;
        $this->cgc = $cgc;
        $this->nome = $nome;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCgc() : string
    {
        return $this->cgc;
    }

    public function getNome() : string
    {
        return $this->nome;
    }    
}

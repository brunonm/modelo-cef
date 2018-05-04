<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Agencia
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
    private $cgc;

    /**
     * @ORM\Column(type="integer", name="digito_verificador")
     * 
     * @var int
     */
    private $digitoVerificador;

    /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="Conta", mappedBy="agencia", cascade={"persist"})
     * 
     * @var Conta[]|array
     */
    private $contas = [];

    public function __construct(string $id, string $cgc, string $nome)
    {
        $this->id = $id;
        $this->cgc = $cgc;
        $this->nome = $nome;
        $this->digitoVerificador = rand(0, 9);
        $this->contas = new ArrayCollection();
    }

    public function abrirConta(
        string $idConta, 
        Cliente $cliente
    ) {
        $numero = $this->proximoNumeroConta();
        $novaConta = new Conta(
            $idConta, 
            $cliente,
            $numero,
            $this
        );
        return $novaConta;
    }

    private function proximoNumeroConta(): string
    {
        $ultimoNumero = 0;
        foreach ($this->contas as $conta) {
            if ($conta->getNumero() > $ultimoNumero) {
                $ultimoNumero = $conta->getNumero();
            }
        }
        return str_pad(++$ultimoNumero, 11, '0', STR_PAD_LEFT);
    }
}

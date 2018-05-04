<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Conta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var Cliente
     */
    private $cliente;

    /**
     * @ORM\Column(type="string")
     * 
     * @var string
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="Agencia", cascade={"persist"})
     * 
     * @var Agencia
     */
    private $agencia;

    /**
     * @var Transacao[]
     */
    private $transacoes;

    public function __construct(
        string $id, 
        Cliente $cliente,
        string $numero,
        Agencia $agencia
    ) {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->numero = $numero;
        $this->agencia = $agencia;
        $this->transacoes = new ArrayCollection();
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getSaldo(): float
    {
        $saldo = 0;
        foreach ($this->transacoes as $transacao) {
            $saldo += $transacao->getValor();
        }
        return $saldo;
    }

    public function depositar(string $transacaoId, float $valor)
    {
        if ($valor < 0.01) {
            throw new DepositoInvalidoException();
        }

        $transacao = Transacao::deposito(
            $transacaoId,
            $valor,
            $this
        );

        $this->transacoes[] = $transacao;
    } 
}

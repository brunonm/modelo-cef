<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Transacao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="criado_em")
     * 
     * @var \DateTime
     */
    private $criadoEm;

    /**
     * @ORM\Column(type="float")
     * 
     * @var float
     */
    private $valor;

    /**
     * @ORM\ManyToOne(targetEntity="Conta", cascade={"persist"})
     * 
     * @var Conta|null
     */
    private $contaOrigem;

    /**
     * @ORM\ManyToOne(targetEntity="Conta", cascade={"persist"})
     * 
     * @var Conta|null
     */
    private $contaDestino;

    /**
     * @ORM\Column(type="string", name="tipo_transacao")
     * 
     * @var TipoTransacao
     */
    private $tipo;

    private function __contruct()
    {}

    public static function transferencia(
        string $id, 
        float $valor,
        Conta $contaOrigem,
        Conta $contaDestino
    ): Transacao {
        $transacao = new self();
        $transacao->id = $id;
        $transacao->valor = $valor;
        $transacao->contaOrigem = $contaOrigem;
        $transacao->contaDestino = $contaDestino;
        $transacao->tipo = TipoTransacao::transferencia();
        $transacao->criadoEm = new \DateTime();
        return $transacao;
    }

    public static function saque(
        string $id, 
        float $valor,
        Conta $contaOrigem
    ): Transacao {
        $transacao = new self();
        $transacao->id = $id;
        $transacao->valor = $valor;
        $transacao->contaOrigem = $contaOrigem;
        $transacao->tipo = TipoTransacao::saque();
        $transacao->criadoEm = new \DateTime();
        return $transacao;
    }

    public static function deposito(
        string $id, 
        float $valor,
        Conta $contaDestino
    ): Transacao {
        $transacao = new self();
        $transacao->id = $id;
        $transacao->valor = $valor;
        $transacao->contaDestino = $contaDestino;
        $transacao->tipo = TipoTransacao::deposito();
        $transacao->criadoEm = new \DateTime();
        return $transacao;
    }

    public function getValor(): float
    {
        return $this->valor;
    }
}

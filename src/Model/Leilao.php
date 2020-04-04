<?php

namespace Alura\Leilao\Model;

use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class Leilao
{
    /** @var Lance[] */
    private $lances;

    /** @var string */
    private $descricao;

    /** @var bool */
    private $finaliza;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
        $this->finaliza = false;
        
    }
    /**
     * Recebe o lance
     *
     * @param Lance $lance
     * @return void
     */
    public function recebeLance(Lance $lance)
    {
        if (!empty($this->lances) && $lance->getUsuario() == $this->ehUltimoUsuario($lance)) {
            throw new \DomainException('Usuario não pode fazer dois lances seguidos');
        }

        $quantidadeLanceUsuarios = $this->quantidadeLancesPorUsuario($lance->getUsuario());
        if ($quantidadeLanceUsuarios >= 5) {
            throw new \DomainException('Usuarios não pode fazer mais de 5 lances no mesmo leilao');
        }

        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    private function ehUltimoUsuario(Lance $lance)
    {
        $ultimoLance = $this->lances[count($this->lances) - 1];
        return $lance->getUsuario() == $ultimoLance->getUsuario();
    }

    /**
     * Retorna quantidade de lances por usuário
     *
     * @param Usuario $usuarios
     * @return integer
     */
    private function quantidadeLancesPorUsuario(Usuario $usuarios): int
    {
        return  array_reduce(
            $this->lances,
            function (int $totalAcumulado, Lance $lancesAtual) use ($usuarios) {
                if ($lancesAtual->getUsuario() == $usuarios) {
                    return $totalAcumulado + 1;
                }
                return $totalAcumulado;
            },
            0
        );
    }

    /**
     * @return void
     */
    public function finaliza()
    {
        $this->finaliza = true;
    }

    /**
     * @return boolean
     */
    public function estaFinalizado(): bool
    {
        return $this->finaliza;
    }
}

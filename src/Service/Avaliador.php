<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $maiorLance;

    public function avaliar(Leilao $leilao): void
    {
        $lance = $leilao->getLances();
        $ultimoValor = $lance[count($lance) - 1];
        $this->maiorLance = $ultimoValor->getValor();
    }

    public function getMaiorLance(): float
    {
        return $this->maiorLance;
    }
}
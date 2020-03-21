<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $maiorLance = 0;

    public function avaliar(Leilao $leilao): void
    {
        foreach($leilao->getLances() as $lance) {
            if($lance->getValor() > $this->maiorLance) {
                $this->maiorLance = $lance->getValor();
            }
        }
    }

    public function getMaiorLance(): float
    {
        return $this->maiorLance;
    }
}

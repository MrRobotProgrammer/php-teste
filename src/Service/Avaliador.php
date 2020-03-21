<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $maiorLance = -INF;
    private $menorValor = INF;

    public function avaliar(Leilao $leilao): void
    {
        foreach($leilao->getLances() as $lance) {
            if($lance->getValor() > $this->maiorLance) {
                $this->maiorLance = $lance->getValor();
            }
            
            if($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();

            }
        }
    }

    /**Undocumented functionUndocumented function
     * Retorna maior valor do lance
     *
     * @return float
     */
    public function getMaiorLance(): float
    {
        return $this->maiorLance;
    }

    /**
     * Retorna menor valor do lance
     *
     * @return float
     */
    public function getMenorValor(): float 
    {
		return $this->menorValor;
	}
}

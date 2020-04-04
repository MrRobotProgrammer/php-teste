<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $maiorLance = -INF;
    private $menorValor = INF;
    private $maioresLances;


    public function avaliar(Leilao $leilao): void
    {
        if ($leilao->estaFinalizado()) {
            throw new \DomainException('Leilão já finalizado');
        }
        if (empty($leilao->getLances())) {
            throw new \DomainException('Não é possível avaliar o leilão');
        }

        foreach($leilao->getLances() as $lance) {
            if($lance->getValor() > $this->maiorLance) {
                $this->maiorLance = $lance->getValor();
            }
            
            if($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();

            }
        }

        $lances = $leilao->getLances();
        usort($lances, function (Lance $lance1, Lance $lance2) {
            return $lance2->getValor() - $lance1->getValor();
        });

        $this->maioresLances = array_slice($lances, 0, 3);
    }


    /**
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
    
    /**
     * Retorna um array de Lances
     *
     * @return array
     */
    public function getMaioresLances() : array
    {
        return $this->maioresLances;
    }
}

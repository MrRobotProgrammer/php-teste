<?php

namespace Alura\Leilao\tests\Models;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $leilao = new Leilao('Variante 80 0Km');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($ana, 2000));

        static::assertCount(1, $leilao->getLances());
        static::assertEquals(1000, $leilao->getLances()[0]->getValor());
    }

    /**
     * @dataProvider geraLanches
     *
     */
    public function testLeilaoDeveReceberLances(
        int $qtd, 
        Leilao $leilao, 
        array $valores
    ){
        static::assertCount($qtd, $leilao->getLances());

        foreach($valores as $i => $valoresLance) {
            static::assertEquals($valoresLance, $leilao->getLances()[$i]->getValor());  
        }
    }

    public function geraLanches()
    {
        $joao = new Usuario('joao');
        $maria = new Usuario('Maria');

        $leilao2Lances = new Leilao('Monza 89 0Km');
        $leilao2Lances->recebeLance(new Lance($joao, 5000));
        $leilao2Lances->recebeLance(new Lance($maria, 10000));

        $leilao1Lance = new Leilao('Monza 89 0Km');
        $leilao1Lance->recebeLance(new Lance($maria, 15000));
        
        return [
            "2- Lances" => [2, $leilao2Lances , [5000, 10000]],
            "1- Lances" => [1, $leilao1Lance, [15000]]
        ];

    }
}
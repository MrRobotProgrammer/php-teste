<?php

namespace Alura\Leilao\tests\Models;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function testLeilaoNaoPodeReceberMaisDe5LancesPorUsuario()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuarios não pode fazer mais de 5 lances no mesmo leilao');

        $leilao = new Leilao("A4 0Km");
        $ana = new Usuario('Anan');
        $gabriel = new Usuario("Gabriel");

        $leilao->recebeLance(new Lance($ana, 10000));
        $leilao->recebeLance(new Lance($gabriel, 15000));
        $leilao->recebeLance(new Lance($ana, 20000));
        $leilao->recebeLance(new Lance($gabriel, 25000));
        $leilao->recebeLance(new Lance($ana, 30000));
        $leilao->recebeLance(new Lance($gabriel, 35000));
        $leilao->recebeLance(new Lance($ana, 40000));
        $leilao->recebeLance(new Lance($gabriel, 45000));
        $leilao->recebeLance(new Lance($ana, 50000));
        $leilao->recebeLance(new Lance($gabriel, 55000));
        $leilao->recebeLance(new Lance($ana, 60000));
    }

    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuario não pode fazer dois lances seguidos');

        $leilao = new Leilao('Variante 80 0Km');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($ana, 2000));
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
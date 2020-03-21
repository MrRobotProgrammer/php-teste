<?php

namespace Alura\Leilao\tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorVerificandoMaiorLanceOrdemCrescente()
    {

        // Arrange - Given / Preparamos o cenário do teste
        $leilao = new Leilao('FIAT 147 0km');

        $maria = new Usuario('maria');
        $joao  = new Usuario('joao');

        $leilao->recebeLance(new Lance($joao, 2500));
        $leilao->recebeLance(new Lance($maria, 10000));
        $leilao->recebeLance(new Lance($maria, 15000));

        $leiloeiro = new Avaliador();

        // Act - When / Executamos o código a ser testado
        $leiloeiro->avaliar($leilao);
        $maiorValor = $leiloeiro->getMaiorLance();

        // Assert - Then / Verificamos se a saída é a esperada

        $this->assertEquals(15000, $maiorValor);
    }

    public function testAvaliadorVerificandoMaiorLanceOrdemDecrescente()
    {

        // Arrange - Given / Preparamos o cenário do teste
        $leilao = new Leilao('FIAT 147 0km');

        $maria = new Usuario('maria');
        $joao  = new Usuario('joao');

        $leilao->recebeLance(new Lance($maria, 10000));
        $leilao->recebeLance(new Lance($joao, 2500));

        $leiloeiro = new Avaliador();

        // Act - When / Executamos o código a ser testado
        $leiloeiro->avaliar($leilao);
        $maiorValor = $leiloeiro->getMaiorLance();

        // Assert - Then / Verificamos se a saída é a esperada
       
        $this->assertEquals(10000, $maiorValor);
    }
}

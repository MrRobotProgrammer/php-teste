<?php

namespace Alura\Leilao\tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    /**
     * Object Avaliador
     *
     * @var Avaliador
     */
    private $leiloeiro;

    protected function setUp(): void
    {
        $this->leiloeiro = new Avaliador;
    }
    public function testAvaliadorVerificandoMaiorLance()
    {
        $leilao = $this->leilaoEmOrdemCrescente();
        $leiloeiro = new Avaliador();

        // Act - When / Executamos o código a ser testado
        $leiloeiro->avaliar($leilao);
        $maiorValor = $leiloeiro->getMaiorLance();

        // Assert - Then / Verificamos se a saída é a esperada

        $this->assertEquals(2500, $maiorValor);
    }

    public function testAvaliadorVerificandoMaiorLanceOrdemDecrescente()
    {

        // Arrange - Given / Preparamos o cenário do teste
        $leilao = $this->leilaoEmOrdemDecrescente();

        $leiloeiro = new Avaliador();

        // Act - When / Executamos o código a ser testado
        $leiloeiro->avaliar($leilao);
        $maiorValor = $leiloeiro->getMaiorLance();

        // Assert - Then / Verificamos se a saída é a esperada

        $this->assertEquals(2500, $maiorValor);
    }

    public function testAvaliadorVerificandoMenorLanceOrdemDecrescente()
    {

        // Arrange - Given / Preparamos o cenário do teste
        $leilao = $this->leilaoEmOrdemDecrescente();
        $leiloeiro = new Avaliador();

        // Act - When / Executamos o código a ser testado
        $leiloeiro->avaliar($leilao);
        $menorValor = $leiloeiro->getMenorValor();

        // Assert - Then / Verificamos se a saída é a esperada

        $this->assertEquals(1000, $menorValor);
    }

    public function testAvaliadorVerificandoMenorLanceOrdemCrescente()
    {

        // Arrange - Given / Preparamos o cenário do teste
        $leilao = $this->leilaoEmOrdemCrescente();

        $leiloeiro = new Avaliador();

        // Act - When / Executamos o código a ser testado
        $leiloeiro->avaliar($leilao);
        $menorValor = $leiloeiro->getMenorValor();

        // Assert - Then / Verificamos se a saída é a esperada

        $this->assertEquals(1000, $menorValor);
    }

    public function testavaliadorDeveBuscar3MaioresValores()
    {
        // Arrange - Give / Preparamos o cenário do teste
        $leilao     = $this->leilaoEmOrdemAleartorio();

        // Act - When / Executamos o código a ser testado
        $leiloeiro = new Avaliador();
        $leiloeiro->avaliar($leilao);
        $maiorValor = $leiloeiro->getMaioresLances();

        // Assert - Then / Verificamos se a saida é a esperada
        static::assertCount(3, $maiorValor, "retornou tres itens da Array");
        static::assertEquals(2500, $maiorValor[0]->getValor());
        static::assertEquals(1500, $maiorValor[1]->getValor());
        static::assertEquals(1000, $maiorValor[2]->getValor());
    }

    public function leilaoEmOrdemCrescente()
    {
        // Arrange - Given / Preparamos o cenário do teste
        $leilao     = new Leilao('FIAT 147 0km');
        $maria      = new Usuario('maria');
        $joao       = new Usuario('joao');
        $henrique   = new Usuario('Henrique');

        $leilao->recebeLance(new Lance($maria, 1000));
        $leilao->recebeLance(new Lance($henrique, 1500));
        $leilao->recebeLance(new Lance($joao, 2500));

        return $leilao;
    }

    public function leilaoEmOrdemDecrescente()
    {
        // Arrange - Given / Preparamos o cenário do teste
        $leilao     = new Leilao('FIAT 147 0km');
        $maria      = new Usuario('maria');
        $joao       = new Usuario('joao');
        $henrique   = new Usuario('Henrique');

        $leilao->recebeLance(new Lance($joao, 2500));
        $leilao->recebeLance(new Lance($henrique, 1500));
        $leilao->recebeLance(new Lance($maria, 1000));

        return $leilao;
    }

    public function leilaoEmOrdemAleartorio()
    {
        // Arrange - Given / Preparamos o cenário do teste
        $leilao     = new Leilao('FIAT 147 0km');
        $maria      = new Usuario('maria');
        $joao       = new Usuario('joao');
        $henrique   = new Usuario('Henrique');

        $leilao->recebeLance(new Lance($maria, 1000));
        $leilao->recebeLance(new Lance($joao, 2500));
        $leilao->recebeLance(new Lance($henrique, 1500));

        return $leilao;
    }
}

<?php

namespace Alura\Leilao\tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use BadFunctionCallException;
use phpDocumentor\Reflection\Types\Object_;
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
        $this->leiloeiro = new Avaliador();
    }


    /**
     * @dataProvider entregaLeiloes
     *
     * @param Leilao $leilao
     * @return void
     */
    public function testAvaliadorVerificandoMaiorLance(Leilao $leilao)
    {
        // Act - When / Executamos o código a ser testado
        $this->leiloeiro->avaliar($leilao);
        $maiorValor = $this->leiloeiro->getMaiorLance();

        // Assert - Then / Verificamos se a saída é a esperada

        $this->assertEquals(2500, $maiorValor);
    }

    /**
     * @dataProvider entregaLeiloes
     *
     * @param Leilao $leilao
     * @return void
     */
    public function testAvaliadorVerificandoMenorLance(Leilao $leilao)
    {
        // Act - When / Executamos o código a ser testado
        $this->leiloeiro->avaliar($leilao);
        $menorValor = $this->leiloeiro->getMenorValor();

        // Assert - Then / Verificamos se a saída é a esperada

        $this->assertEquals(1000, $menorValor);
    }

    /**
     * @dataProvider entregaLeiloes
     *
     * @param Leilao $leilao
     * @return void
     */
    public function testavaliadorDeveBuscar3MaioresValores(Leilao $leilao)
    {
        // Act - When / Executamos o código a ser testado
        $this->leiloeiro->avaliar($leilao);
        $maiorValor = $this->leiloeiro->getMaioresLances();

        // Assert - Then / Verificamos se a saida é a esperada
        static::assertCount(3, $maiorValor, "retornou tres itens da Array");
        static::assertEquals(2500, $maiorValor[0]->getValor());
        static::assertEquals(1500, $maiorValor[1]->getValor());
        static::assertEquals(1000, $maiorValor[2]->getValor());
    }

    /**
     * DataProvider
     * @return Object
     */
    public function leilaoEmOrdemCrescente(): Object
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

    /**
     * DataProvider
     * @return Object
     */
    public function leilaoEmOrdemDecrescente(): Object
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

    /**
     * DataProvider
     * @return Object
     */
    public function leilaoEmOrdemAleartorio(): object
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

    /**
     * DataProvider
     * @return array
     */
    public function entregaLeiloes(): array
    {
        return [
            "ordem-crescente"   => [$this->leilaoEmOrdemCrescente()],
            "ordem-deCrescente" => [$this->leilaoEmOrdemDecrescente()],
            "ordem-aleartorio"  => [$this->leilaoEmOrdemAleartorio()]
        ];
    }

    /**
     * @return void
     */
    public function testLeilaoVazioNaoPodeSerAvalido()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar o leilão');
        $leilao = new Leilao('Fusca Azul');
        $this->leiloeiro->avaliar($leilao);
    }

    /**
     * @return void
     */
    public function testLeilaoFinalizadoNaoPodeSerAvaliado()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Leilão já finalizado');

        $leilao = new Leilao('Fiat 147 oKm');
        $maria = new Usuario('Maria');
        $leilao->recebeLance(new Lance($maria, 1000));
        $leilao->finalizar();

        $this->leiloeiro->avaliar($leilao);
    }
}

<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

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
$valorEsperado = 15000;

if($valorEsperado == $maiorValor) {
    echo "TESTE OK";
}else{
    echo "TESTE ERROR";
}

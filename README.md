# php_teste

- branch "[what-test](https://github.com/MrRobotProgrammer/php-teste/tree/what-test)"

    -   Para garantir a qualidade do código, devemos escrever testes;   
    -   Um teste também é código;
    -   Um teste sempre segue um estrutura padrão, que tem três partes:
        *   A inicialização do cenário (Arrange ou Given)
        *   A execução da regra de negócio (Act ou When)
        *   A verificação do resultado (Assert ou Then)

    -   A tarefa do teste é dar um feedback rápido e claro sobre a corretude do nosso código.
    
    ************************************************************************************************
- branch "[phpUnit-test](https://github.com/MrRobotProgrammer/php-teste/tree/phpUnit-test)"

    -   O PHPUnit é uma ferramenta para executar testes de maneira automatizada
    -   O executável do PHPUnit se encontra na pasta vendor/bin
    -   Para escrever um teste com PHPUnit, devemos criar uma classe de teste
    -   Uma classe de teste segue algumas regras:
        *   Começa com o nome da classe que está sendo testada e usa o sufixo Test, por exemplo: AvaliadorTest, em geral ClasseASerTestadaTest
        *   A classe de teste deve estender a classe TestCase
        *   O método de teste deve começa com test
        *   O método de teste deve ter um nome que diz o que estamos testando

************************************************************************************************
- branch "[classes-de-equivalencia](https://github.com/MrRobotProgrammer/php-teste/tree/classes-de-equivalencia)"

    -   Sobre classes de equivalência do mundo de testes, que descrevem similaridades entre os cenários de testes
        *   Isto é importante para descobrir quantos testes devemos criar
        *   A ideia é criar nenhum teste a mais ou a menos
        *   Um teste também é um código que precisa ser mantido
    -   Para ordenar uma lista, você pode usar a função usort
    - Para fatiar uma lista, você pode usar a função array_slice

************************************************************************************************
- branch "[organizing_tests](https://github.com/MrRobotProgrammer/php-teste/tree/organizing_tests)"

    -   Sobre Data Providers, os provedores de dados permitem que "alimentemos" os testes com cenários diversos, sem repetir o código e os asserts
    -   Que existe um método setUp, que é chamado antes de cada testes
    -   Que os provedores de dados sempre são executados antes do método setup
    -   Que caso queiramos executar algum código antes dos provedores de dados, existe o método setUpBeforeClass
    -   Que, análogo ao setUp e setUpBeforeClass, existem os métodos tearDown e tearDownAfterClass, para executar um código após os testes

************************************************************************************************
- branch "[test-drive-development](https://github.com/MrRobotProgrammer/php-teste/tree/test-drive-development)"

    -   Sobre TDD, o Test Driven Development
    -   Que o TDD define um ciclo de desenvolvimento guiado pelo teste:
        *   Escrevemos um teste, que ainda não vai passar
        *   Implementamos a funcionalidade, que faz o teste passar
        *   Refatoramos (melhoramos, simplificamos) o código
    -   Que o TDD ajuda que tenhamos um teste para cada funcionalidade
        *   Ele também documenta e simplifica classe
    -   Que devemos implementar a funcionalidade em pequenos passos, chamados de baby steps, sempre guiados pelos testes

************************************************************************************************
- branch "[test-exceptions](https://github.com/MrRobotProgrammer/php-teste/tree/test-exceptions)"
    -   Como verificar que o código lança as exceções esperadas
        *   Em geral, exceções também fazem parte das regras de negócio e precisam ser verificadas
        *   Para tal o PHPUnit oferece os métodos expectException e expectExceptionMessage da classe TestCase:
            *   expectException(\NomeDaExcecao::class)
            *   expectExceptionMessage(mensagemDeExcecao)
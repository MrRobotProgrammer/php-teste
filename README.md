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

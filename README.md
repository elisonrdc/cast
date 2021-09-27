<p align="center">
    <h1 align="center">AVALIAÇÃO TÉCNICA – CASTGROUP</h1>
</p>

OBJETIVO
--------

Criar uma aplicação web integrando as tecnologias PHP 7+ / Yii2 (Backend) e Angular 6+ (Frontend), de forma que seja possível realizar operações de pesquisa, inclusão, alteração e exclusão (CRUD) de Cursos para turmas de formação da Castgroup.

ESTUTURA BÁSICA YII2
--------------------

      assets/             contém definição de ativos
      commands/           contém comandos de console (controladores)
      config/             contém configurações de aplicativos
      controllers/        contém classes de controlador da Web
      mail/               contém arquivos de visualização para e-mails
      models/             contém classes de modelo
      modules/            contém classes de módulos
      runtime/            contém arquivos gerados durante o tempo de execução
      tests/              contém vários testes para o aplicativo básico
      utils/              contém classes utilitárias
      vendor/             contém pacotes de terceiros dependentes
      views/              contém arquivos de visualização para o aplicativo da Web
      web/                contém o script de entrada e recursos da Web



REQUISITOS
----------

O requisito mínimo para este projeto é o PHP 7.2.33 ou superior.


INSTALAÇÃO
----------

### Baixar dependências

~~~
composer update OU composer install
~~~

### Acesse o aplicativo por meio do seguinte URL:

~~~
http://localhost/cast/
~~~

### Acesse a documentação da API RESTful por meio da URL:

~~~
http://localhost/cast/api/docs
~~~

CONFIGURAÇÃO
------------

### Banco de Dados

Edite o arquivo `config/db.php` com dados reais, por exemplo:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=cast',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

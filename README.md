# Framework API - Open Source

## Índice

1. [Introdução](#introduction)
2. [Arquitetura](#architecture)
3. [Helpers](#helpers)
4. [Model](#model)
5. [Controller](#controller)
6. [Middleware](#middleware)
7. [Routes](#routes)
8. [Parâmetros](#routes)
9. [Banco de dados](#database)
10. [JSON Web Token](#json)

#

## Introdução <a name="introduction"></a>

> O projeto Framework API está sendo desenvolvido visando uma melhor eficiência e padronização para modelos atuais de api's rest, podendo ser usada externamente, visto que existem módulos para autenticação via JWT sendo possível a adição de novos módulos via Composer.

#

## Arquitetura <a name="architecture"></a>

> Para o desenvolvimento não foi utilizado nenhum framework, porém a arquitetura do projeto foi baseado em symfony e laravel de uma forma simplificada e minimalista utilizando módulos para compor os endpoints e middlewares.

#

## Helpers <a name="helpers"></a>

> O diretório 'helpers' do projeto é o local onde criamos nossas Classes com funções abstratas que nos ajudam no tratamento de informações da api. <br />

> helpers/example.help.php

      class Example {
        publi static function example($params) {
          // TRATAMENTO DA INFORMAÇÂO
          //
          return $response
        }
      }

#

## Model <a name="model"></a>

> O diretório 'model' do projeto é o local onde criamos nossas classes em que iremos realizar alterações no banco de dados. <br />
> Recomenda-se instanciar a conexão com banco no construtor das classes do model, segue exemplo:

> model/example.model.php

      class ExampleModel {
        private $DB;

        public function __construct() {
          $this->DB = PdoConnection::getInstance();
        }
      }

#

## Controller <a name="controller"></a>

> O diretório 'controller' do projeto é o local onde criamos nossas classes com seus respectivos endpoints. <br />
> Recomenda-se instanciar a classe Model no construtor, segue exemplo:

> controller/example.controller.php

      use Symfony\Component\HttpFoundation\Request;

      class Example
      {
          private $item_model;

          public function __construct()
          {
              $this->item_model = new ExampleModel();
          }

          public function index(Resquest $request) {
            // TRATAMENTO DA INFORMAÇÂO


            <-- Resposta da requisição -->
            $data['code']     = REQUEST_CODE;
            $data['status']   = REQUEST_STATUS;
            $data['response'] = RESQUEST_RESPONSE;
            return $data;
          }
      }

> MUITO IMPORTANTE: acrescentar o uso da biblioteca request no começo de cada classe dos controllers para funcionamento correto da API <br/> <br/> > **use Symfony\Component\HttpFoundation\Request;**

#

## Middlewares <a name="middleware"></a>

> O diretório 'middleware' do projeto é o local onde criamos nossos middlewares, os middlewares tem o intuito de interceptar e tratar a requisição fazendo validações por exemplo

> middleware/example.php <br />

    class Example {
        public function handle() {
          // TRATAMENTO DA INFORMAÇÂO
          //
          <-- Resposta da requisição -->
          $response['error'] = RESPONSE;
          self::sendResponse($response, 401);
        }


        // Retorna resposta ao cliente
        private static function sendResponse($message, $code)
        {
            $response = new JsonResponse($message, $code);
            $response->send();
            exit;
        }
    }

> index.php

    Necessário informar os middlewares antes das rotas

    > Route::middleware(MIDDLEWARE_CLASSNAME::class);

#

## Routes <a name="routes"></a>

> Local onde importamos os módulos, middlewares e helpers criados as classes terem acesso e cadastramos nossas rotas, segue o examplo:

> TYPE: (get, put, patch, post, delete)

    Route::TYPE('/ROUTER_NAME', [MODULE_CLASSNAME::class, 'ENDPOINT_NAME']);

> Exemplo em uso: Route::get('/tickets', [TicketApi::class, 'index']);

#

#

## Parâmetros <a name="parameters"></a>

> Temos diferentes modos para utilizar parâmetros, como por exemplo:

    Router Params > $request->parameters->PARAMETER_NAME;

    Query Params > $request->query->get('PARAMETER_NAME');

    Body Params > $request->request->get('PARAMETER_NAME');

    Header Params > $request->headers->get('PARAMETER_NAME');

> Para utilizar os routers params é necessário ter uma configuração da rota, como na situação abaixo caso você precise capturar o ID de um produto:

    Route::TYPE('/products/{id}', [MODULE_CLASSNAME::class, 'ENDPOINT_NAME']);

#

#

## Banco de dados <a name="database"></a>

> Para conexão ao banco de dados por default temos um arquivo préconfigurado, onde basta informar as informações de conexão com o banco, a conexão é feita via PDO, para configurar é necessário abrir o seguinte arquivo: API > CORE > PdoConnection.class.php

    Dentro do arquivo temos uma classe para conexão com o banco, nesse momento, basta visualizar a função getInstance, dentro dela temos as variáveis

    > $servername = "localhost";
    > $port = "3306";
    > $username = "USERNAME";
    > $password = "PASSWORD";
    > $dbname = "DATABASE_NAME";

    Ao informar as variáveis sua api já está pronta para se conectar ao banco de dados.

> Para utilizar as funções do PDO segue documentação: <a href="https://www.php.net/manual/pt_BR/book.pdo.php">Documetação PDO</a>

#

## JSON Web Token <a name="json"></a>

> Temos um helper pronto para utilização de JWT, desenvoldido utilizando a biblioteca firebase/php-jwt

    > Checar integridade do jwt: JwtHelper::checkJwtIntegrity($JWT_TOKEN);

    > Decodifica o jwt: JwtHelper::decode($JWT_TOKEN, $JWT_KEY);

    > Encodifica o jwt: JwtHelper::encode($PAYLOAD, $JWT_KEY);

#

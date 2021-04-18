<?php

class PdoConnection
{
    private static $instancia;



    /**
     *
     * @return object PDO connection
     *
     */
    public static function getInstance()
    {
        if (!isset(self::$instancia)) {
            try {

                // ========= CONFIGURAÇÂO DO BANCO DE DADOS (MYSQL) =========

                $servername = "localhost";      // Preencha aqui com o IP do seu banco de dados.
                $port = "3306";                 // Preencha aqui com a Porta do seu banco de dados.
                $username = "USERNAME";         // Preencha aqui com o usuario do seu banco de dados.
                $password = "PASSWORD";         // Preencha aqui com a senha do seu banco de dados.
                $dbname = "DATABASE_NAME";      // Preencha aqui com o nome do seu banco de dados.



                $dsn = "mysql:host=$servername;port=$port;dbname=$dbname";

                self::$instancia = new PDO($dsn, $username, $password);

                // Gerando um excessão do tipo PDOException com o código de erro
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit();
            }
        }
        return self::$instancia;
    }
}

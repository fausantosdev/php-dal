<?php

namespace App;

use PDO;
use PDOException;

class Connection
{
    // Membros somente da classe para que nunca tenha um novo objeto instanciando a conexão
    private static string $driver = 'mysql';
    private static string $host = 'localhost';
    private static string $database = 'fullstackphp';
    private static string $user = 'root';
    private static string $password = '';
    private static array $option = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,# Feedback de erros.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL# Conversão de nome de colunas.
    ];

    /**
     * Armament o objeto PDO
     * @var PDO|null
     */
    private static ?PDO $instance = null;

    /**
     * Armazena os erros
     * @var PDOException|null
     */
    private static ?PDOException $error = null;

    /**
     * Retorna a conexão com o banco de dados
     * @return PDO|null
     */
    public final static function getConnection(): ?PDO
    {
        // Garante que tenha apenas um objeto, uma conexão por usuário.
        if(empty(self::$instance))
        {
            try{
                self::$instance = new PDO(
                    self::$driver . ":host=" . self::$host . ";dbname=" . self::$database,
                    self::$user,
                    self::$password,
                    self::$option
                );
            }catch (PDOException $exception){
                self::$error = $exception; // Armazena o erro
                return null; // Retorna nulo se houver erro
            }
        }

        return self::$instance;
    }

    /**
     * @return PDOException|null
     */
    public final static function getError(): ?PDOException
    {
        return self::$error;
    }
}

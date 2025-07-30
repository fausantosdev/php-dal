<?php

namespace App;

use PDOException;
use PDOStatement;

class Crud
{
    /**
     * @var PDOStatement $crud
     */
    private PDOStatement $crud;

    /**
     * @var integer $count
     */
    private int $count;

    /**
     * Armazena o resultado das consultas
     * @var mixed
     */
    private mixed $data = null;

    /**
     * Armazena o número de linhas afetadas pelo update
     * @var int
     */
    private int $rowCount;

    /**
     * Armazena os erros
     * @var array
     */
    private array $fail = [];

    /**
     * Retorna os erros em um array
     * @return array
     */
    public function fail(): array
    {
        return $this->fail;
    }

    /**
     * Seta os erros
     * @param string $error
     */
    public function setFail(string $error): void
    {
        // array_push($this->fail, $error);
        $this->fail[] = $error;
    }

    /**
     * Retorna o resultado das consultas
     * @return mixed
     */
    public function data(): mixed
    {
        return $this->data;
    }

    /**
     * Definir os dados
     * @param mixed $data
     * @return void
     */
    protected function setData(mixed $data): void
    {
        $this->data = $data;
    }

    /**
     * Preparação das declarativas - preparação das queries.
     *
     * @param string $query
     * @param array $params
     */
    private function preparedStatements(string $query, array $params = []): void
    {
        $this->countParams($params);// Conta os parâmetros. ↑↑
        $this->crud = Connection::getConnection()->prepare($query);# Prepara a query.($crud armazena a query)

        if($this->count > 0)# Se ouver parâmetros / (select * from)<- não tem parâmetros
        {
            for($i = 1; $i <= $this->count; $i++)
            {
                $type = is_numeric($params[$i-1]) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $this->crud->bindValue($i, $params[$i-1], $type);# -1 porque arrays começam com 0.
                //                ↑↑↑ Associa um valor a um parâmetro / envia os bindValues de acordo com a quantidade de parâmetros.
            }
        }

        # Se for (select * from), passa direto pro execute() ↓↓↓
        $this->crud->execute(); # Executa a query(que anteriormente foi armazenada na $crud)
        $this->rowCount = $this->crud->rowCount();# Armazenará o número de linhas afetadas pelo update.
    }

    /**
     * Contador de parâmetros.
     *
     * Conta os parâmetros e insere a quantidade no atributo count.
     *
     * @param array $params
     */
    private function countParams(array $params): void
    {
        $this->count = count($params);
    }

    /**
     * INSERT
     *
     * @param string $table
     * @param string $values
     * @param array $params
     * @return bool
     */
    public function insert(string $table, string $values, array $params = []): bool
    {
        try {
            $this->preparedStatements("INSERT INTO {$table} VALUES({$values})", $params);
            $this->data = (int) Connection::getConnection()->lastInsertId();
            return true;
        }catch (\PDOException $exception){
            //array_push($this->fail, $exception->getMessage());
            $this->setFail($exception->getMessage());
            return false;
        }
    }

    /**
     * READ
     *
     * Os campos, a tabela, a condição e os parâmetros.
     *
     * @param string $fields
     * @param string $table
     * @param string $condition
     * @param array $params
     * @return bool
     */
    public function select(string $fields, string $table, string $condition, array $params = []): bool
    {
        try {
            $this->preparedStatements("SELECT {$fields} FROM {$table} {$condition}", $params);
            $this->data = $this->crud->fetchAll();
            return true;
        }catch (PDOException $exception){
            $this->setFail($exception->getMessage());
            return false;
        }
    }

    /**
     * UPDATE
     *
     * @param string $table
     * @param string $set
     * @param string $condition
     * @param array $params
     * @return bool
     */
    public function update(string $table, string $set, string $condition, array $params = []): bool
    {
        try {
            $this->preparedStatements("UPDATE {$table} SET {$set} WHERE {$condition}", $params);
            $this->data = $this->rowCount;
            return true;
        }catch (PDOException $exception){
            $this->setFail($exception->getMessage());
            return false;
        }
    }

    /**
     * DELETE
     *
     * @param string $table
     * @param string $condition
     * @param array $params
     * @return bool
     */
    public function delete(string $table, string $condition, array $params = []): bool
    {
        try {
            $this->preparedStatements("DELETE FROM {$table} WHERE {$condition}", $params);
            return true;
        }catch (PDOException $exception){
            $this->setFail($exception->getMessage());
            return false;
        }
    }
}

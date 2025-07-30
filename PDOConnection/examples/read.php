<?php
require_once '../../vendor/autoload.php';

use PDOConnection\App\Crud;

$crud = new Crud();

$result = $crud->select(
    '*',
    'users',
    '', // WHERE email = ?
     [] // [ 'fallsantosdev@hotmail.com' ]
);

echo '<pre>';
var_dump(
    $result,      // Retorna true ou false
    $crud->data(),// Retorna o resultado da consulta
    $crud->fail() // Retorna os erros
);
echo '</pre>';
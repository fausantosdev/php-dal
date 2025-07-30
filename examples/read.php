<?php
require_once '../vendor/autoload.php';

$dal = new \App\Dal();

$result = $dal->select(
    '*',
    'users',
    '', // WHERE email = ?
     [] // [ 'fallsantosdev@hotmail.com' ]
);

echo '<pre>';
var_dump(
    $result,      // Retorna true ou false
    $dal->data(),// Retorna o resultado da consulta
    $dal->fail() // Retorna os erros
);
echo '</pre>';
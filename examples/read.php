<?php
require_once '../vendor/autoload.php';

$dbg = new \App\DatabaseGetway();

$result = $dbg->select(
    '*',
    'users',
    'ORDER BY id DESC LIMIT 3', // WHERE email = ?
     [] // [ 'fallsantosdev@hotmail.com' ]
);

echo '<pre>';
var_dump(
    $result,     // Retorna true ou false
    $dbg->data(),// Retorna o resultado da consulta
    $dbg->fail() // Retorna os erros
);
echo '</pre>';
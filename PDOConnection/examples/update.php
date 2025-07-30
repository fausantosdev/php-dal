<?php

require_once '../../vendor/autoload.php';

$crud = new \PDOConnection\App\Crud();

$result = $crud->update(
    'users',
    'document=?',// Se adicionar mais campos, separar por vírgula
    'id=?',// Condição
    [
        '123456789',
        56
    ]
);

echo '<pre>';
var_dump(
    $result,
    $crud->data(),
    $crud->fail()
);
echo '</pre>';
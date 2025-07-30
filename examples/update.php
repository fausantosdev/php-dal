<?php

require_once '../../vendor/autoload.php';

$dal = new \App\Dal();

$result = $dal->update(
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
    $dal->data(),
    $dal->fail()
);
echo '</pre>';
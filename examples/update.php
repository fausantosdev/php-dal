<?php

require_once '../vendor/autoload.php';

$dbg = new \App\DatabaseGetway();

$result = $dbg->update(
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
    $dbg->data(),
    $dbg->fail()
);
echo '</pre>';
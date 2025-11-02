<?php

require_once '../vendor/autoload.php';

$dbg = new \App\DatabaseGetway();

$result = $dbg->insert(
    'users',
    'default,?,?,?,?,default,default,default,default,default,default,default,default',
    [
        'John',
        'Doe',
        'johndoe@gmail.com',
        '456def'
    ]
);

echo '<pre>';
var_dump(
    $result,
    $dbg->data(),
    $dbg->fail()
);
echo '</pre>';
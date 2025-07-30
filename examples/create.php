<?php

require_once '../../vendor/autoload.php';

$dal = new \App\Dal();

$result = $dal->insert(
    'users',
    'default,?,?,?,default,?,default,default,default,default,default',
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
    $dal->data(),
    $dal->fail()
);
echo '</pre>';
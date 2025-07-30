<?php

require_once '../../vendor/autoload.php';

$crud = new \App\Crud();

$result = $crud->insert(
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
    $crud->data(),
    $crud->fail()
);
echo '</pre>';
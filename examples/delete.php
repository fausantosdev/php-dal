<?php

require_once '../../vendor/autoload.php';

$crud = new \App\Crud();

$result = $crud->delete(
    'users',
    'id=?',
    [ 56 ]
);

echo '<pre>';
var_dump(
    $result,
    $crud->data(),
    $crud->fail()
);
echo '</pre>';
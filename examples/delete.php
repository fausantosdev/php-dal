<?php

require_once '../vendor/autoload.php';

$dal = new \App\DatabaseGetWay();

$result = $dal->delete(
    'users',
    'id=?',
    [ 56 ]
);

echo '<pre>';
var_dump(
    $result,
    $dal->data(),
    $dal->fail()
);
echo '</pre>';
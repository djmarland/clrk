<?php
return [
    'hostname'  => '127.0.0.1',
    'user'      => getenv('DB_USER'),
    'password'  => getenv('DB_PASSWORD'),
    'driver' => 'pdo_mysql',
    'db_prefix' => 'client_'
];
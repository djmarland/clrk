<?php
return [
    'from'      => getenv('EMAIL_FROM'),
    'host'      => getenv('EMAIL_HOST'),
    'username'  => getenv('EMAIL_USER'),
    'password'  => getenv('EMAIL_PASSWORD')
];

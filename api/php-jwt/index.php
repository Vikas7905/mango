<?php
require 'JwtHandler.php';
$jwt = new JwtHandler();

$token = $jwt->_jwt_encode_data(
    'http://localhost/pspnews/php_jwt/',
    array("email"=>"john@email.com","id"=>21)
);

echo "<strong>Your Token is -</strong><br> $token";
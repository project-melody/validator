<?php
use Melody\Validation\Validator as v;

$config['registering'] = array(
    'name' => v::maxLength(50),
    'email' => v::email()->maxLength(50),
    'username' => v::length(6, 12)->alnum()->noWhitespace(),
    'password' => v::length(6, 12)->containsSpecial(1)->containsLetter(3)->containsDigit(2)->noWhitespace()
);

return $config;

Melody Validation
=================

[![Build Status](https://secure.travis-ci.org/marcelsud/melody-validation.png)](http://travis-ci.org/marcelsud/melody-validation)

Melody Validation is a set of validation rules with a easy way to customize and test your validations that works with PHP 5.3.3 or later.

## Installation

The recommended way to install Melody Validation is [through
composer](http://getcomposer.org). Just create a `composer.json` file and
run the `php composer.phar install` command to install it:

    {
        "require": {
            "marcelsud/melody-validation": "dev-master"
        }
    }

## Usage

Importing Validator namespace:
```php
use Melody\Validation\Validator as v;
```php

Validating email:
```php
$email = "test@mail.com";

$validator = new Validator();
$validator->validate($email, v::email()); //true

$violations = $validator->getViolations(); //List all violation messages
```

Reuse the constraints as you wish.
```php
$username = "valid@username.com";
$validEmail = v::email();

//Reusing $validEmail constraint
$validUsername = $validEmail->add(v::maxLength(15)->minLength(5));

$validator->validate($username, $validUsername);//true
```

Valid Password Example:
```php
$password = "pass@2012";
$validPassword = v::length(6, 12) //Minlength 6, Maxlength 12
    ->containsSpecial(1) //at least 1 special character
    ->containsLetter(3) //at least 3 letters
    ->containsDigit(2); //at least 2 digits

$validator->validate($password, $validPassword); //true
```

Melody Validation
=================

[![Build Status](https://secure.travis-ci.org/marcelsud/melody-validation.png)](http://travis-ci.org/marcelsud/melody-validation)

Melody Validation is a set of validation rules with a easy way to customize validation groups.
It works with PHP 5.3.3 or later.

- You can use chained validation like: v::email()->noWhitespace()->length(5,20)->validate("valid@email.com");
- You can set custom messages
- You can reuse the rules as you wish in a smart way
- [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) autoloading is compatible.

Installation
------------

The recommended way to install Melody Validation is [through
composer](http://getcomposer.org). Just create a `composer.json` file and
run the `php composer.phar install` command to install it:

    {
        "require": {
            "marcelsud/melody-validation": "dev-master"
        }
    }

Introduction
------------

Importing Validator namespace:
```php
use Melody\Validation\Validator as v;
```

Basic Usage
-----------
### Chained validation
```php
$password = "pass@2012";
v::length(6, 12) // Length between 6 and 12 characters
    ->containsSpecial(1) // at least 1 special character
    ->containsLetter(3) // at least 3 letters
    ->containsDigit(2) // at least 2 digits
    ->validate($password); // true
```

### Getting violation messages
```php
$email = "test@mail.com";

$emailValidator = v::email();
$emailValidator->validate($email); //true

$violations = $emailValidator->getViolations(); //List all violation messages
```

### Constraints reuse
```php
$username = "valid@username.com";
$validEmail = v::email();

//Reusing $validEmail constraint
$validUsername = $validEmail->add(v::maxLength(15)->minLength(5));
$validUsername->validate($username);//true
```

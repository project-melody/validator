Melody Validation
=================

[![Build Status](https://secure.travis-ci.org/marcelsud/melody-validation.png)](http://travis-ci.org/marcelsud/melody-validation)

Melody Validation is a set of validation rules with an easy way to customize validation groups.
It works with PHP 5.3.3 or later.

- You can use chained validation like: v::email()->noWhitespace()->length(5,20)->validate("valid@email.com");
- You can set custom messages
- You can reuse the rules as you wish in a smart way
- You can load validation groups from YML and PHP files
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

Rules
-----
### Alnum
Only alphanumeric strings accepted:
```php
$alnumValidator = v::alnum();
$alnumValidator->validate("valid"); //true
$alnumValidator->validate("#invalid"); //false
```

### ContainsDigit (integer $minimum)
Minimum of digits (0-9) occurences in the input string:
```php
$containsDigitValidator = v::containsDigit(3); // Minimum 3 digits
$containsDigitValidator->validate(123); //true
$containsDigitValidator->validate("12a"); //false
```

### ContainsLetter (integer $minimum)
Minimum of letters (a-z or A-Z) occurences in the input string:
```php
$containsLetterValidator = v::containsLetter(1); // Minimum 1 letter
$containsLetterValidator->validate("123a"); //true
$containsLetterValidator->validate("1234"); //false
```

### ContainsSpecial (integer $minimum)
Minimum of special characters occurences in the input string:
```php
$containsSpecialValidator = v::containsSpecial(1); // Minimum 1 special character
$containsSpecialValidator->validate("123@"); //true
$containsSpecialValidator->validate("1234"); //false
```

### Email
Only valid emails accepted:
```php
$emailValidator = v::email();
$emailValidator->validate("valid@email.com"); //true
$emailValidator->validate("invalid#@email.com"); //false
```

### Length (integer $minLength, integer $maxLength)
Ensures that the length of the string is between the min and max:
```php
$lengthValidator = v::length(5, 10);
$lengthValidator->validate("Valid"); //true
$lengthValidator->validate("Invalid string"); //false
```

### Min (integer $min)
Requires a given minimum number:
```php
$minValidator = v::min(10);
$minValidator->validate(10); //true
$minValidator->validate(9); //false
```

### Max (integer $input)
Requires a given maximum number:
```php
$maxValidator = v::max(10);
$maxValidator->validate(10); //true
$maxValidator->validate(11); //false
```

### MaxLength (integer $max)
Validates if the string has the maximum length specified
```php
$maxValidator = v::max(10);
$maxValidator->validate(10); //true
$maxValidator->validate(11); //false
```

### NoWhitespace ()
Validates if a string contains no whitespace:
```php
$noWhitespaceValidator = v::noWhitespace();
$noWhitespaceValidator->validate("validstring"); //true
$noWhitespaceValidator->validate("invalid string"); //false
```

### Range (integer $min, integer $max)
Validates if a number is between the minimum and maxim specified:
```php
$rangeValidator = v::range(5, 10);
$rangeValidator->validate(7); //true
$rangeValidator->validate(4); //false
```

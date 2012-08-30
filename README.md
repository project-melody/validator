Melody Validation 
=================

[![Build Status](https://secure.travis-ci.org/marcelsud/melody-validation.png)](http://travis-ci.org/marcelsud/melody-validation)

Melody Validation is a set of validation rules with a easy way to customize and test your validations.

```php
<?php
use Melody\Validation\Validator;
use Melody\Validation\Constraints\EmailConstraint;

require_once __DIR__.'/../vendor/autoload.php';

$email = "test...@mail.com";
$validator = new Validator();
$validator->addConstraint(new EmailConstraint());

if (!$validator->validate($email)) {
    $violations = $validator->getViolations();
}

```

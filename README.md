Melody Validation
=================

[![Build Status](https://secure.travis-ci.org/marcelsud/melody-validation.png)](http://travis-ci.org/marcelsud/melody-validation)

Melody Validation is a set of validation rules with a easy way to customize and test your validations.

```php
<?php
use Melody\Validation\Validator;
use Melody\Validation\Constraints\ConstraintsBuilder as c;

require_once __DIR__.'/../vendor/autoload.php';
```

Validate using both Validator or Constraint validate method.
```php
$email = "test@mail.com";
$validator = new Validator();

$validEmail = c::email();
$validEmail->validate($email); //true
$validator->validate($email, $validEmail); //true

$violations = $validator->getViolations(); //List of Violations
```

Reuse the constraints as you wish.
```php
// Remember $validEmail?
$validUsername = $validEmail->add(c::maxLength(15)->minLength(5));

$username = "valid@username.com";

$validUsername->validate($username); //true
$violations = $validator->getViolations(); //List of Violations
```

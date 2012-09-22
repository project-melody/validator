<?php

namespace Melody\Validation;

use Melody\Validation\ConstraintsBuilder as c;
use Melody\Validation\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_validate_email()
    {
        $validator = new Validator();
        $this->assertTrue($validator->validate("marcelsud@gmail.com", c::email()));
        $this->assertFalse($validator->validate("marcelsud @gmail.com", c::email()));
    }
}

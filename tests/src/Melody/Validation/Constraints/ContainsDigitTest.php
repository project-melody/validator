<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class ContainsDigitTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(v::containsDigit(2)->validate('abcdef0123'));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(v::containsDigit(5)->validate('abcdef0123'));
    }

}
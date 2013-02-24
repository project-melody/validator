<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NotEmptyTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(v::notEmpty()->validate("a"));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(v::notEmpty()->validate("     "));
        $this->assertFalse(v::notEmpty()->validate(" "));
        $this->assertFalse(v::notEmpty()->validate(""));
    }

}

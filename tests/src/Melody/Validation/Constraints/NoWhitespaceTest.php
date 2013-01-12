<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\ConstraintsBuilder as c;

class NoWhitespaceTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(c::noWhitespace()->validate("abcdef01234"));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(c::noWhitespace()->validate("abcdef 01234"));
    }

}

<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NoWhitespaceTest extends \PHPUnit_Framework_TestCase
{

    public function testValidStringShouldPass()
    {
        $this->assertTrue(v::noWhitespace()->validate("abcdef01234"));
    }

    public function testInvalidStringShouldFailValidation()
    {
        $this->assertFalse(v::noWhitespace()->validate("abcdef 01234"));
    }
}

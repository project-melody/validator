<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class ContainsLetterTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(v::containsLetter(5)->validate('abcdef0123'));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(v::containsLetter(7)->validate('abcdef0123'));
    }

}

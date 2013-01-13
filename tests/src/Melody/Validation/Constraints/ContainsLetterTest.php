<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class ContainsSpecialTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(v::containsSpecial(1)->validate('abcde@f0123'));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(v::containsSpecial(1)->validate('abcdef0123'));
    }

}

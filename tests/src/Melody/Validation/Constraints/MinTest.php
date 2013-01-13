<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class MinTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_min_number_should_pass()
    {
        $this->assertTrue(v::min(5)->validate(7));
    }

    public function test_invalid_min_number_should_fail_validation()
    {
        $this->assertFalse(v::min(5)->validate(4));
    }

}

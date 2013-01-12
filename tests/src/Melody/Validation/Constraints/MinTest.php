<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\ConstraintsBuilder as c;

class MinTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_min_number_should_pass()
    {
        $this->assertTrue(c::min(5)->validate(7));
    }

    public function test_invalid_min_number_should_fail_validation()
    {
        $this->assertFalse(c::min(5)->validate(4));
    }

}

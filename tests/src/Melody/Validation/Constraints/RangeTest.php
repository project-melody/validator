<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\ConstraintsBuilder as c;

class RangeTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_number_should_pass()
    {
        $this->assertTrue(c::range(5, 10)->validate(5));
        $this->assertTrue(c::range(5, 10)->validate(6));
        $this->assertTrue(c::range(5, 10)->validate(7));
        $this->assertTrue(c::range(5, 10)->validate(8));
        $this->assertTrue(c::range(5, 10)->validate(9));
        $this->assertTrue(c::range(5, 10)->validate(10));
    }

    public function test_invalid_number_should_fail_validation()
    {
        $this->assertFalse(c::range(5, 10)->validate(3));
        $this->assertFalse(c::range(5, 10)->validate(4));
        $this->assertFalse(c::range(5, 10)->validate(11));
        $this->assertFalse(c::range(5, 10)->validate(12));
    }

}

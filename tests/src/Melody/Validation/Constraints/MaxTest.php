<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\ConstraintsBuilder as c;

class MaxTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_max_number_should_pass()
    {
        $this->assertTrue(c::max(5)->validate(4));
    }

    public function test_invalid_max_number_should_fail_validation()
    {
        $this->assertFalse(c::containsLetter(5)->validate(7));
    }

}

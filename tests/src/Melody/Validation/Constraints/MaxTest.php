<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class MaxTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_max_number_should_pass()
    {
        $this->assertTrue(v::max(5)->validate(4));
    }

    public function test_invalid_max_number_should_fail_validation()
    {
        $this->assertFalse(v::max(5)->validate(7));
    }

    public function test_not_string_argument_exception()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::max(5)->validate(null));
    }

}

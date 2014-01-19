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

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function test_invalid_parameter_should_raise_an_exception()
    {
        v::max(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function test_invalid_input_should_raise_an_exception()
    {
        v::max(5)->validate(new \stdClass());
    }
}

<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class LengthTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(v::length(5, 10)->validate('abcdef0123'));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(v::length(2, 5)->validate('abcdef0123'));
        $this->assertFalse(v::length(2, 5)->validate(''));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function test_invalid_min_parameter_should_raise_an_exception()
    {
        v::length("invalid argument", 5);
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function test_invalid_max_parameter_should_raise_an_exception()
    {
        v::length(2, "invalid argument");
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function test_invalid_input_should_raise_an_exception()
    {
        v::length(2, 5)->validate(1);
    }
}

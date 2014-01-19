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

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function test_invalid_parameter_should_raise_an_exception()
    {
        v::min(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function test_invalid_input_should_raise_an_exception()
    {
        v::min(5)->validate(new \stdClass());
    }
}

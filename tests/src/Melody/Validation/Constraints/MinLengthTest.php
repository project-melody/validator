<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class MinLengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidStrings
     */
    public function test_valid_string_should_pass($validString)
    {
        $this->assertTrue(v::minLength(3)->validate($validString));
    }

    /**
     * @dataProvider providerForInvalidStrings
     */
    public function test_invalid_string_should_fail_validation($invalidString)
    {
        $this->assertFalse(v::minLength(10)->validate($invalidString));
    }

    public function providerForValidStrings()
    {
        return array(
                array('abc'),
                array('abcdef'),
                array('abcdef1234')
        );
    }

    public function providerForInvalidStrings()
    {
        return array(
                array('abcd'),
                array('abcdef'),
                array('abcdef123')
        );
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function test_invalid_parameter_should_raise_an_exception()
    {
        v::minLength(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function test_invalid_input_should_raise_an_exception()
    {
        v::minLength(5)->validate(new \stdClass());
    }

}

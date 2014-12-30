<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class MinLengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidStrings
     */
    public function testValidStringShouldPass($validString)
    {
        $this->assertTrue(v::minLength(3)->validate($validString));
    }

    /**
     * @dataProvider providerForInvalidStrings
     */
    public function testInvalidStringShouldFailValidation($invalidString)
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
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::minLength(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::minLength(5)->validate(new \stdClass());
    }
}

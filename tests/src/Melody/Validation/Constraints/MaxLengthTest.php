<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class MaxLengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidStrings
     */
    public function testValidStringShouldPass($validString)
    {
        $this->assertTrue(v::maxLength(10)->validate($validString));
    }

    /**
     * @dataProvider providerForInvalidStrings
     */
    public function testInvalidStringShouldFailValidation($invalidString)
    {
        $this->assertFalse(v::maxLength(3)->validate($invalidString));
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
                array('abcdef1234')
        );
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::maxLength(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::maxLength(5)->validate(new \stdClass());
    }
}

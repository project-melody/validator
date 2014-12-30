<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class LengthTest extends \PHPUnit_Framework_TestCase
{

    public function testValidStringShouldPass()
    {
        $this->assertTrue(v::length(5, 10)->validate('abcdef0123'));
    }

    public function testInvalidStringShouldFailValidation()
    {
        $this->assertFalse(v::length(2, 5)->validate('abcdef0123'));
        $this->assertFalse(v::length(2, 5)->validate(''));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidMinParameterShouldRaiseAnException()
    {
        v::length("invalid argument", 5);
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidMaxParameterShouldRaiseAnException()
    {
        v::length(2, "invalid argument");
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::length(2, 5)->validate(1);
    }
}

<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class RangeTest extends \PHPUnit_Framework_TestCase
{

    public function testValidNumberShouldPass()
    {
        $this->assertTrue(v::range(5, 10)->validate(5));
        $this->assertTrue(v::range(5, 10)->validate(6));
        $this->assertTrue(v::range(5, 10)->validate(7));
        $this->assertTrue(v::range(5, 10)->validate(8));
        $this->assertTrue(v::range(5, 10)->validate(9));
        $this->assertTrue(v::range(5, 10)->validate(10));
    }

    public function testInvalidNumberShouldFailValidation()
    {
        $this->assertFalse(v::range(5, 10)->validate(3));
        $this->assertFalse(v::range(5, 10)->validate(4));
        $this->assertFalse(v::range(5, 10)->validate(11));
        $this->assertFalse(v::range(5, 10)->validate(12));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidMinParameterShouldRaiseAnException()
    {
        v::range("invalid argument", 10);
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidMaxParameterShouldRaiseAnException()
    {
        v::range(5, "invalid argument");
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::range(5, 10)->validate("invalid argument");
    }
}

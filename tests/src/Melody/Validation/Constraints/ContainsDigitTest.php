<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class ContainsDigitTest extends \PHPUnit_Framework_TestCase
{

    public function testValidStringShouldPass()
    {
        $this->assertTrue(v::containsDigit(2)->validate('abcdef0123'));
    }

    public function testInvalidStringShouldFail()
    {
        $this->assertFalse(v::containsDigit(5)->validate('abcdef0123'));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::containsDigit(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::containsDigit(5)->validate(new \stdClass());
    }
}

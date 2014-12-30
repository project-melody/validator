<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class ContainsLetterTest extends \PHPUnit_Framework_TestCase
{
    public function testValidStringShouldPass()
    {
        $this->assertTrue(v::containsLetter(1)->validate('abcdef0123'));
    }

    public function testInvalidStringShouldFailValidation()
    {
        $this->assertFalse(v::containsLetter(1)->validate('0123'));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::containsLetter(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::containsLetter(5)->validate(new \stdClass());
    }
}

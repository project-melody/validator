<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class ContainsSpecialTest extends \PHPUnit_Framework_TestCase
{

    public function testValidStringShouldPass()
    {
        $this->assertTrue(v::containsSpecial(1)->validate('abcdef@0123'));
    }

    public function testInvalidStringShouldFailValidation()
    {
        $this->assertFalse(v::containsSpecial(1)->validate('abcdef0123'));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::containsSpecial(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::containsSpecial(5)->validate(new \stdClass());
    }
}

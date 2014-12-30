<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class MinTest extends \PHPUnit_Framework_TestCase
{

    public function testValidMinNumberShouldPass()
    {
        $this->assertTrue(v::min(5)->validate(7));
    }

    public function testInvalidMinNumberShouldFailValidation()
    {
        $this->assertFalse(v::min(5)->validate(4));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::min(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::min(5)->validate(new \stdClass());
    }
}

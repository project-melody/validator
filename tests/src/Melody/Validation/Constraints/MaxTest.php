<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class MaxTest extends \PHPUnit_Framework_TestCase
{

    public function testValidMaxNumberShouldPass()
    {
        $this->assertTrue(v::max(5)->validate(4));
    }

    public function testInvalidMaxNumberShouldFailValidation()
    {
        $this->assertFalse(v::max(5)->validate(7));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::max(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::max(5)->validate(new \stdClass());
    }
}

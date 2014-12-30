<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class AlnumTest extends \PHPUnit_Framework_TestCase
{

    public function testValidStringShouldPass()
    {
        $this->assertTrue(v::alnum()->validate('abcdef0123'));
    }

    public function testInvalidStringShouldFailValidation()
    {
        $this->assertFalse(v::alnum()->validate(' abcdef0123'));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::alnum()->validate(new \stdClass());
    }
}

<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class AlnumTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(v::alnum()->validate('abcdef0123'));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(v::alnum()->validate(' abcdef0123'));
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function test_invalid_input_should_raise_an_exception()
    {
        v::alnum()->validate(new \stdClass());
    }
}

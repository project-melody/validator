<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class LengthTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(v::length(5, 10)->validate('abcdef0123'));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(v::length(2, 5)->validate('abcdef0123'));
        $this->assertFalse(v::length(2, 5)->validate(''));
    }

    public function test_invalid_argument_exception_min()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::length("invalid argument", 5)->validate('abcdef0123'));
    }

    public function test_invalid_argument_exception_max()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::length(2, "invalid argument")->validate('abcdef0123'));
    }

    public function test_invalid_argument_exception_not_string()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::length(2, 5)->validate(1));
    }
}

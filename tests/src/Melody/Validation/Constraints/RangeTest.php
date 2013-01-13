<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class RangeTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_number_should_pass()
    {
        $this->assertTrue(v::range(5, 10)->validate(5));
        $this->assertTrue(v::range(5, 10)->validate(6));
        $this->assertTrue(v::range(5, 10)->validate(7));
        $this->assertTrue(v::range(5, 10)->validate(8));
        $this->assertTrue(v::range(5, 10)->validate(9));
        $this->assertTrue(v::range(5, 10)->validate(10));
    }

    public function test_invalid_number_should_fail_validation()
    {
        $this->assertFalse(v::range(5, 10)->validate(3));
        $this->assertFalse(v::range(5, 10)->validate(4));
        $this->assertFalse(v::range(5, 10)->validate(11));
        $this->assertFalse(v::range(5, 10)->validate(12));
    }

    public function test_invalid_argument_exception_min()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::range("invalid argument", 10)->validate(3));
    }

    public function test_invalid_argument_exception_max()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::range(5, "invalid argument")->validate(3));
    }

    public function test_invalid_argument_exception_not_int()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::range(5, 10)->validate("invalid argument"));
    }

}

<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class MaxLengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidStrings
     */
    public function test_valid_string_should_pass($validString)
    {
        $this->assertTrue(v::maxLength(10)->validate($validString));
    }

    /**
     * @dataProvider providerForInvalidStrings
     */
    public function test_invalid_string_should_fail_validation($invalidString)
    {
        $this->assertFalse(v::maxLength(3)->validate($invalidString));
    }

    public function providerForValidStrings()
    {
        return array(
                array('abc'),
                array('abcdef'),
                array('abcdef1234')
        );
    }

    public function providerForInvalidStrings()
    {
        return array(
                array('abcd'),
                array('abcdef'),
                array('abcdef1234')
        );
    }

    public function test_not_string_argument_exception()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::maxLength(5)->validate(null));
    }

}

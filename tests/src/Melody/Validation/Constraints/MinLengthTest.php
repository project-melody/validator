<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\ConstraintsBuilder as c;

class MinLengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidStrings
     */
    public function test_valid_string_should_pass($validString)
    {
        $this->assertTrue(c::minLength(3)->validate($validString));
    }

    /**
     * @dataProvider providerForInvalidStrings
     */
    public function test_invalid_string_should_fail_validation($invalidString)
    {
        $this->assertFalse(c::minLength(10)->validate($invalidString));
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
                array('abcdef123')
        );
    }

}

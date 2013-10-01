<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NotEmptyTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForNotEmpty
     */
    public function test_valid_string_should_pass($input)
    {
        $this->assertTrue(v::notEmpty()->validate($input));
    }

    /**
     * @dataProvider providerForEmpty
     */
    public function test_invalid_string_should_fail_validation($input)
    {
        $this->assertFalse(v::notEmpty()->validate($input));
    }

    public function providerForNotEmpty()
    {
        return array(
            array(new \stdClass),
            array(array(666)),
            array(array(0)),
            array(' name'),
            array(1)
        );
    }

    public function providerForEmpty()
    {
        return array(
            array(''),
            array('    '),
            array("\n"),
            array(false),
            array(null)
        );
    }
}

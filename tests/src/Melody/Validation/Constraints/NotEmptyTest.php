<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NotEmptyTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForNotEmpty
     */
    public function testValidStringShouldPass($input)
    {
        $this->assertTrue(v::notEmpty()->validate($input));
    }

    /**
     * @dataProvider providerForEmpty
     */
    public function testInvalidStringShouldFailValidation($input)
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

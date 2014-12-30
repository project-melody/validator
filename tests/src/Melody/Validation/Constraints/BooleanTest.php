<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class BooleanTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider validBooleanProvider
     */
    public function testValidBooleanShouldWork($input)
    {
        $this->assertTrue(v::boolean()->validate($input));
    }

    /**
     * @dataProvider invalidBooleanProvider
     */
    public function testInvalidBooleanShouldNotWork($input)
    {
        $this->assertFalse(v::boolean()->validate($input));
    }

    public function validBooleanProvider()
    {
        return array(
            array(true),
            array(false)
        );
    }

    public function invalidBooleanProvider()
    {
        return array(
            array(1.2),
            array("@"),
            array(10 / 3),
            array(""),
            array(new \stdClass()),
            array(1),
            array(0),
            array(null)
        );
    }
}

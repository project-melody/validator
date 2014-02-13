<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class BooleanTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider validBooleanProvider
     */
    public function test_valid_boolean_should_work($input)
    {
        $this->assertTrue(v::boolean()->validate($input));
    }

    /**
     * @dataProvider invalidBooleanProvider
     */
    public function test_invalid_boolean_should_not_work($input)
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

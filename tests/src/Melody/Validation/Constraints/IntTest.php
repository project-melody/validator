<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class IntTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider validIntProvider
     */
    public function testValidIntShouldWork($input)
    {
        $this->assertTrue(v::int()->validate($input));
    }

    /**
     * @dataProvider invalidIntProvider
     */
    public function testInvalidIntShouldNotWork($input)
    {
        $this->assertFalse(v::int()->validate($input));
    }

    public function validIntProvider()
    {
        return array(
            array(1),
            array(15),
            array(10 / 2),
            array(10 % 2),
            array((int) (10 / 3))
        );
    }

    public function invalidIntProvider()
    {
        return array(
            array(1.2),
            array("@"),
            array(10 / 3)
        );
    }
}

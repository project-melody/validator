<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider validNumberProvider
     */
    public function testValidNumberShouldWork($input)
    {
        $this->assertTrue(v::number()->validate($input));
    }

    /**
     * @dataProvider invalidNumberProvider
     */
    public function testInvalidNumberShouldNotWork($input)
    {
        $this->assertFalse(v::number()->validate($input));
    }

    public function validNumberProvider()
    {
        return array(
            array(1),
            array("2"),
            array(10 / 2),
            array(10 % 2),
            array((int) (10 / 3))
        );
    }

    public function invalidNumberProvider()
    {
        return array(
            array(null),
            array("@")
        );
    }
}

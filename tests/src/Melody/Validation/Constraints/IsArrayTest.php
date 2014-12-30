<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class IsArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validArrayProvider
     */
    public function testValidArrayShouldWork($array)
    {
        $this->assertTrue(v::isArray()->validate($array));
    }

    /**
     * @dataProvider invalidArrayProvider
     */
    public function testInvalidArrayShouldNotWork($input)
    {
        $this->assertFalse(v::isArray()->validate($input));
    }

    public function validArrayProvider()
    {
        return array(
            array(array()),
            array(new \ArrayObject())
        );
    }

    public function invalidArrayProvider()
    {
        return array(
            array(new \stdClass),
            array("string"),
            array(1234)
        );
    }
}

<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class ObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validObjectProvider
     */
    public function testValidObjectShouldWork($input)
    {
        $this->assertTrue(v::object()->validate($input));
    }

    /**
     * @dataProvider invalidObjectProvider
     */
    public function testInvalidObjectShouldNotWork($input)
    {
        $this->assertFalse(v::object()->validate($input));
    }

    public function validObjectProvider()
    {
        return array(
            array(new \Exception()),
            array(new \DateTime()),
            array(new \stdClass())
        );
    }

    public function invalidObjectProvider()
    {
        return array(
            array(array()),
            array("string"),
            array(1234)
        );
    }
}

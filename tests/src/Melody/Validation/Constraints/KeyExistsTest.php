<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class KeyExistsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validArrayProvider
     */
    public function testValidKeyExistsShouldWork($key, $array)
    {
        $this->assertTrue(v::keyExists($key)->validate($array));
    }

    /**
     * @dataProvider invalidArrayProvider
     */
    public function testInvalidArrayShouldNotWork($key, $input)
    {
        $this->assertFalse(v::keyExists($key)->validate($input));
    }

    public function validArrayProvider()
    {
        $arrImpl = new \ArrayObject();
        $arrImpl->offsetSet("name", "John Doe");

        return array(
            array("name", array("name" => "John Doe")),
            array("name", $arrImpl)
        );
    }

    public function invalidArrayProvider()
    {
        return array(
            array("name", array()),
            array("name", new \ArrayObject())
        );
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::keyExists(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::keyExists("name")->validate(new \stdClass());
    }
}

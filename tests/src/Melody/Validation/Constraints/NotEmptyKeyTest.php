<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NotEmptyKeyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validArrayProvider
     */
    public function testValidKeyShouldWork($key, $array)
    {
        $this->assertTrue(v::notEmptyKey($key)->validate($array));
    }

    /**
     * @dataProvider invalidArrayProvider
     */
    public function testInvalidArrayShouldNotWork($key, $input)
    {
        $this->assertFalse(v::notEmptyKey($key)->validate($input));
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
        $arrImpl = new \ArrayObject();
        $arrImpl->offsetSet("name", "");

        return array(
            array("name", array("name" => "")),
            array("name", $arrImpl)
        );
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::notEmptyKey(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::notEmptyKey("name")->validate(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testNonExistentKeyShouldRaiseAnException()
    {
        v::notEmptyKey("name")->validate(array());
    }
}

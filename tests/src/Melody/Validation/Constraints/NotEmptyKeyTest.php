<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NotEmptyKeyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validArrayProvider
     */
    public function test_valid_not_empty_key_should_work($key, $array)
    {
        $this->assertTrue(v::notEmptyKey($key)->validate($array));
    }

    /**
     * @dataProvider invalidArrayProvider
     */
    public function test_invalid_array_should_not_work($key, $input)
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
    public function test_invalid_parameter_should_raise_an_exception()
    {
        v::notEmptyKey(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function test_invalid_input_should_raise_an_exception()
    {
        v::notEmptyKey("name")->validate(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function test_non_existent_key_should_raise_an_exception()
    {
        v::notEmptyKey("name")->validate(array());
    }
}

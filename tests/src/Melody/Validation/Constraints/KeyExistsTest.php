<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class KeyExistsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validArrayProvider
     */
    public function test_valid_key_exists_should_work($key, $array)
    {
        $this->assertTrue(v::keyExists($key)->validate($array));
    }

    /**
     * @dataProvider invalidArrayProvider
     */
    public function test_invalid_array_should_not_work($key, $input)
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
    public function test_invalid_parameter_should_raise_an_exception()
    {
        v::keyExists(new \stdClass());
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function test_invalid_input_should_raise_an_exception()
    {
        v::keyExists("name")->validate(new \stdClass());
    }
}

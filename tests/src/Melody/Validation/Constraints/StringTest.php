<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class StringTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider validStringProvider
     */
    public function test_valid_string_should_work($input)
    {
        $this->assertTrue(v::string()->validate($input));
    }

    /**
     * @dataProvider invalidStringProvider
     */
    public function test_invalid_int_should_not_work($input)
    {
        $this->assertFalse(v::string()->validate($input));
    }

    public function validStringProvider()
    {
        return array(
            array('12.87'),
            array(''),
        );
    }

    public function invalidStringProvider()
    {
        return array(
            array(null),
            array(array()),
            array(new \stdClass),
            array(255)
        );
    }
}

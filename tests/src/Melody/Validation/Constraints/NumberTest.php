<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider validNumberProvider
     */
    public function test_valid_number_should_work($input)
    {
        $this->assertTrue(v::number()->validate($input));
    }

    /**
     * @dataProvider invalidNumberProvider
     */
    public function test_invalid_number_should_not_work($input)
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
            array("@"), 
            array(array()),
            array(new \stdClass)
        );
    }
}

<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class IntTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider validIntProvider
     */
    public function test_valid_int_should_work($input)
    {
        $this->assertTrue(v::int()->validate($input));
    }

    /**
     * @dataProvider invalidIntProvider
     */
    public function test_invalid_int_should_not_work($input)
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

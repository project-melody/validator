<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class StringTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider validStringProvider
     */
    public function testValidStringShouldWork($input)
    {
        $this->assertTrue(v::string()->validate($input));
    }

    /**
     * @dataProvider invalidStringProvider
     */
    public function testInvalidStringShouldNotWork($input)
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
            array(13.4),
            array(255)
        );
    }
}

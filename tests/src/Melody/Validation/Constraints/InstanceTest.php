<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class InstanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validInstanceProvider
     */
    public function testValidInstanceShouldWork($object, $class)
    {
        $this->assertTrue(v::instance($class)->validate($object));
    }

    /**
     * @dataProvider invalidInstanceProvider
     */
    public function testInvalidInstanceShouldNotWork($object, $class)
    {
        $this->assertFalse(v::instance($class)->validate($object));
    }

    public function validInstanceProvider()
    {
        return array(
            array(new \Exception(), '\Exception'),
            array(new \DateTime(), '\DateTime'),
            array(new v(), 'Melody\Validation\Validator')
        );
    }

    public function invalidInstanceProvider()
    {
        return array(
            array(array(), '\stdClass'),
            array("string", '\stdClass'),
            array(1234, '\stdClass')
        );
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testInvalidParameterShouldRaiseAnException()
    {
        v::instance(new \stdClass());
    }
}

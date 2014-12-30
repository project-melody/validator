<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class EmailTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidEmail
     */
    public function testValidEmailShouldPass($validEmail)
    {
        $this->assertTrue(v::email()->validate($validEmail));
    }

    /**
     * @dataProvider providerForInvalidEmail
     */
    public function testInvalidEmailsShouldFailValidation($invalidEmail)
    {
        $this->assertFalse(v::email()->validate($invalidEmail));
    }

    public function providerForValidEmail()
    {
        return array(
            array('test@test.com'),
            array('mail+mail@gmail.com'),
            array('mail.email@e.test.com'),
            array('a@a.a')
        );
    }

    public function providerForInvalidEmail()
    {
        return array(
            array('test@test'),
            array('test'),
            array('test@тест.рф'),
            array('@test.com'),
            array('mail@test@test.com'),
            array('test.test@'),
            array('test.@test.com'),
            array('test@.test.com'),
            array('test@test..com'),
            array('test@test.com.'),
            array('.test@test.com')
        );
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testInvalidInputShouldRaiseAnException()
    {
        v::email()->validate(new \stdClass());
    }
}

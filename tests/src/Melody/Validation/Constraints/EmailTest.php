<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\ConstraintsBuilder as c;

class EmailTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidEmail
     */
    public function test_valid_email_should_pass($validEmail)
    {
        $this->assertTrue(c::email()->validate($validEmail));
    }

    /**
     * @dataProvider providerForInvalidEmail
     */
    public function test_invalid_emails_should_fail_validation($invalidEmail)
    {
        $this->assertFalse(c::email()->validate($invalidEmail));
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

}

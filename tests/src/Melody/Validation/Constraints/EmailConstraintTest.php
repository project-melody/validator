<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Constraints\EmailConstraint;
use Melody\Validation\Validator;

class EmailConstraintTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidEmail
     */
    public function test_valid_email_should_pass($validEmail)
    {
        $validator = new EmailConstraint();
        $this->assertTrue($validator->validate($validEmail));
    }

    /**
     * @dataProvider providerForInvalidEmail
     */
    public function test_invalid_emails_should_fail_validation($invalidEmail)
    {
        $validator = new EmailConstraint();
        $this->assertFalse($validator->validate($invalidEmail));
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

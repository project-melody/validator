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

    /**
     * Verify if EmailCostraint implements Validatable
     */
    public function test_verify_if_email_costraint_is_validatable()
    {
    	$this->assertTrue(new EmailConstraint() instanceof Validatable);
    }

    /**
     * Verify new EmailConstraint default validation group
     */
    public function test_verify_new_constraint_default_validation_group()
    {
    	$validator = new Validator();
    	$emailConstraint = new EmailConstraint();
    	$this->assertEquals(BaseConstraint::DEFAULT_GROUP, $emailConstraint->getValidationGroup());
    }

    /**
     * Add EmailConstraint with specified validation group
     */
    public function test_add_constraint_with_specified_validation_group()
    {
    	$validator = new Validator();
    	$emailConstraint = new EmailConstraint();
    	$this->assertTrue($validator->addConstraint($emailConstraint, "login") instanceof Validator);
    	$this->assertEquals("login", $emailConstraint->getValidationGroup());
    }

    public function test_add_constraint_with_custom_message()
    {
    	$validator = new Validator();
    	$emailConstraint = new EmailConstraint(null, "Invalid email!");
    	$validator->addConstraint($emailConstraint);

    	$this->assertEquals("Invalid email!", $emailConstraint->getErrorMessageTemplate());
    }

    public function test_add_multiple_email_constraints()
    {
    	$validator = new Validator();
    	$emailConstraint = new EmailConstraint();

    	$this->assertTrue($validator->addConstraint($emailConstraint, "login") instanceof Validator);
    	$this->assertEquals("login", $emailConstraint->getValidationGroup());

    	$this->assertTrue($validator->addConstraint($emailConstraint, "register") instanceof Validator);
    	$this->assertEquals("register", $emailConstraint->getValidationGroup());
    }

    public function test_add_multiple_email_constraints_array()
    {
    	$validator = new Validator();
    	$emailConstraint = new EmailConstraint();

    	$this->assertTrue($validator->addConstraint($emailConstraint, array("login", "register")) instanceof Validator);
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

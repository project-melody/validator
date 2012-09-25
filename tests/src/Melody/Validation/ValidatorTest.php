<?php

namespace Melody\Validation;

use Melody\Validation\ConstraintsBuilder as c;
use Melody\Validation\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_validate_email()
    {
        $validator = new Validator();
        $email = "valid@email.com";

        $validEmail = c::email();

        $this->assertTrue($validEmail->validate($email));
        $this->assertTrue($validator->validate($email, $validEmail));
    }

    public function test_validate_with_constraint_reuse()
    {
    	$validEmail = c::email();
    	$validUsername = $validEmail->add(c::minLength(10)->maxLength(20));

    	$username = "valid@username.com";
		$invalidMinLength = "invalid";
		$invalidMaxLength = "invalid";
		$invalidUsername = "invalid @email.com";

    	$this->assertTrue($validUsername->validate($username));
    	$this->assertFalse($validUsername->validate($invalidMinLength));
    	$this->assertFalse($validUsername->validate($invalidMaxLength));
    	$this->assertFalse($validUsername->validate($invalidUsername));
    }

}

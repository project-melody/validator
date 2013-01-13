<?php

namespace Melody\Validation;

use Melody\Validation\Common\Collections\ConstraintsCollection;
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

    public function test_validate_with_not_statement()
    {
        $validator = new Validator();

        $username = "marcelsud";
        $validUsername = c::length(6, 12)->alnum()->noWhitespace();
        $this->assertTrue($validUsername->validate($username));

        $password = "pass@2012";
        $validPassword = c::length(6, 12)
            ->containsSpecial(1)
            ->containsLetter(3)
            ->containsDigit(2)
            ->noWhitespace();

        $this->assertTrue($validator->validate($password, $validPassword));
        $this->assertTrue($validPassword->validate($password));
    }

    public function test_custom_messages_configuration()
    {
        $validator = new Validator();
        $validEmail = c::email();

        $validator->validate("marcelsud @gmail.com", $validEmail);
        $errors = $validator->getViolations(array(
                'email' => "'{{input}}' deve conter um email válido"
        ));

        $this->assertEquals($errors['email'], "'marcelsud @gmail.com' deve conter um email válido");
    }
}

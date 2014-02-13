<?php

namespace Melody\Validation;

use Melody\Validation\Validator as v;
use Melody\Validation\Constraints\Constraint;

class PasswordConstraint extends Constraint
{
    protected $id = 'password';

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new InvalidInputException("The input must be a string");
        }

        return v::length(6, 12) // Length between 6 and 12 characters
            ->containsSpecial(1) // at least 1 special character
            ->containsLetter(3) // at least 3 letters
            ->containsDigit(2) // at least 2 digits
            ->validate($input);
    }

    public function getErrorMessageTemplate()
    {
        return "The password is invalid";
    }
}

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_validate_email()
    {
        $validator = new Validator();
        $email = "valid@email.com";

        $validEmail = v::email();

        $this->assertTrue($validEmail->validate($email));
        $this->assertTrue($validator->validate($email, $validEmail));
    }

    public function test_validate_with_constraint_reuse()
    {
        $validEmail = v::email();
        $validUsername = $validEmail->add(v::minLength(10)->maxLength(20));

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
        $validUsername = v::length(6, 12)->alnum()->noWhitespace();
        $this->assertTrue($validUsername->validate($username));

        $password = "pass@2012";
        $validPassword = v::length(6, 12)
            ->containsSpecial(1)
            ->containsLetter(3)
            ->containsDigit(2)
            ->noWhitespace();

        $this->assertTrue($validator->validate($password, $validPassword));
        $this->assertTrue($validPassword->validate($password));
    }

    public function test_custom_messages_from_validator_configuration()
    {
        $validator = new Validator();

        $validator->validate("email @gmail.com", v::email());
        $errors = $validator->getViolations(array(
                'email' => "'{{input}}' deve conter um email válido"
        ));

        $this->assertEquals($errors['email'], "'email @gmail.com' deve conter um email válido");
    }

    public function test_custom_messages_from_chained_validator_configuration()
    {
        $validEmail = v::email();
        $validEmail->validate("email @gmail.com");
        $errors = $validEmail->getViolations(array(
                'email' => "'{{input}}' deve conter um email válido"
        ));

        $this->assertEquals($errors['email'], "'email @gmail.com' deve conter um email válido");
    }

    public function test_add_custom_constraint_should_work()
    {
        $validator = new Validator();
        $validator->registerConstraint(new PasswordConstraint());

        $this->assertTrue($validator->password()->validate("pass@2012"));
        $this->assertFalse($validator->password()->validate("12345678"));
    }

}

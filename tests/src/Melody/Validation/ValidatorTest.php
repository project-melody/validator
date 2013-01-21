<?php

namespace Melody\Validation;

use Melody\Validation\Common\Collections\ConstraintsCollection;
use Melody\Validation\ValidationGroupsFactory;
use Melody\Validation\Validator as v;

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

        $validator->validate("marcelsud @gmail.com", v::email());
        $errors = $validator->getViolations(array(
                'email' => "'{{input}}' deve conter um email válido"
        ));

        $this->assertEquals($errors['email'], "'marcelsud @gmail.com' deve conter um email válido");
    }

    public function test_custom_messages_from_chained_validator_configuration()
    {
        $validEmail = v::email();
        $validEmail->validate("marcelsud @gmail.com");
        $errors = $validEmail->getViolations(array(
                'email' => "'{{input}}' deve conter um email válido"
        ));

        $this->assertEquals($errors['email'], "'marcelsud @gmail.com' deve conter um email válido");
    }

    public function test_diplicated_constraint_exception()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', v::email()->email());
    }

    public function test_validation_groups_from_array()
    {
        $config['registering'] = array(
                'name' => v::maxLength(50),
                'email' => v::email()->maxLength(50),
                'username' => v::length(6, 12)->alnum()->noWhitespace(),
                'password' => v::length(6, 12)->containsSpecial(1)->containsLetter(3)->containsDigit(2)->noWhitespace()
        );

        $validationGroups = ValidationGroupsFactory::build($config);
        $this->assertInstanceOf('Melody\Validation\ValidationGroups', $validationGroups);
    }

    public function test_validation_groups_from_php()
    {
        $validationGroups = ValidationGroupsFactory::buildFromFile(__DIR__ . '/../../Resources/config/validation.php');
        $this->assertInstanceOf('Melody\Validation\ValidationGroups', $validationGroups);
    }

    public function test_validation_groups_from_yml()
    {
        $validationGroups = ValidationGroupsFactory::buildFromFile(__DIR__ . '/../../Resources/config/validation.yml');
        $this->assertInstanceOf('Melody\Validation\ValidationGroups', $validationGroups);
    }

    public function test_validation_groups_import_file_not_found()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', ValidationGroupsFactory::buildFromFile("file/not/found"));
    }

    public function test_validation_groups_methods()
    {
        $constraintsCollection = new ConstraintsCollection();
        $constraintsCollection->set('name', v::maxLength(50));
        $constraintsCollection->set('email', v::email()->maxLength(50));

        $validationGroups = new ValidationGroups();
        $validationGroups->add("registering", $constraintsCollection);

        $this->assertTrue($validationGroups->has("registering"));
        $this->assertInstanceOf('Melody\Validation\Common\Collections\ConstraintsCollection', $validationGroups->get("registering"));

        $validationGroups->remove("registering");
        $this->assertFalse($validationGroups->has("registering"));

        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', $validationGroups->get("registering"));
    }

    public function test_validation_groups_import_not_accepted_file_format()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', ValidationGroupsFactory::buildFromFile(__DIR__ . '/../../Resources/config/validation.ini'));
    }
}

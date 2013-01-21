<?php

namespace Melody\Validation;

use Melody\Validation\Common\Collections\ConstraintsCollection;
use Melody\Validation\ValidationGroupsFactory;
use Melody\Validation\Validator as v;

class ValidationGroupsTest extends \PHPUnit_Framework_TestCase
{

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

        $input['name'] = "Marcelo Santos";
        $input['email'] = "marcelsud@gmail.com";
        $input['username'] = "marcelsud";
        $input['password'] = "pass@2013";

        $this->assertTrue($validationGroups->validate($input, "registering"));
    }

    public function test_validation_groups_custom_messages()
    {
        $config['registering']['email'] = v::email()->maxLength(50);
        $config['updating']['email'] = v::email()->maxLength(10);

        $validationGroups = ValidationGroupsFactory::build($config);
        $input['email'] = "marcelsud @gmail.com";

        $validationGroups->validate($input, "registering", array(
                'email' => "'{{input}}' deve conter um email válido"
        ));

        $errors = $validationGroups->getViolations();
        $this->assertEquals($errors['email'], "'marcelsud @gmail.com' deve conter um email válido");

        $this->assertFalse($validationGroups->validate($input, "updating"));
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

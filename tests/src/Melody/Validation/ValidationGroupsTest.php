<?php

namespace Melody\Validation;

use Melody\Validation\ValidationGroups\Parser\YamlParserStrategy;
use Melody\Validation\ValidationGroups\Parser\ArrayParserStrategy;
use Melody\Validation\ValidationGroups\Parser\PHPParserStrategy;
use Melody\Validation\ValidationGroups\ValidationGroupsFactory;
use Melody\Validation\ValidationGroups\ValidationGroups;
use Melody\Validation\Common\Collections\ConstraintsCollection;
use Melody\Validation\Validator as v;

class ValidationGroupsTest extends \PHPUnit_Framework_TestCase
{

    public function testValidationGroupsFromArray()
    {
        $config['registering'] = array(
                'name' => v::maxLength(50),
                'email' => v::email()->maxLength(50),
                'username' => v::length(6, 12)->alnum()->noWhitespace(),
                'password' => v::length(6, 12)->containsSpecial(1)->containsLetter(3)->containsDigit(2)->noWhitespace()
        );

        $validationGroups = ValidationGroupsFactory::build(new ArrayParserStrategy($config));
        $this->assertInstanceOf('Melody\Validation\ValidationGroups\ValidationGroups', $validationGroups);

        $input['name'] = "Marcelo Santos";
        $input['email'] = "email@gmail.com";
        $input['username'] = "marcelsud";
        $input['password'] = "pass@2013";

        $this->assertTrue($validationGroups->validate($input, "registering"));
    }

    public function testValidationGroupsCustomMessages()
    {
        $config['registering']['email'] = v::email()->maxLength(50);
        $config['updating']['email'] = v::email()->maxLength(10);

        $validationGroups = ValidationGroupsFactory::build(new ArrayParserStrategy($config));
        $input['email'] = "email @gmail.com";

        $validationGroups->validate($input, "registering", array(
                'email' => "'{{input}}' deve conter um email válido"
        ));

        $errors = $validationGroups->getViolations();
        $this->assertEquals($errors['email'], "'email @gmail.com' deve conter um email válido");

        $this->assertFalse($validationGroups->validate($input, "updating"));
    }

    public function testValidationGroupsFromPhp()
    {
        $validationGroups = ValidationGroupsFactory::build(new PHPParserStrategy(
            __DIR__ . '/../../Resources/config/validation.php'
        ));
        $this->assertInstanceOf('Melody\Validation\ValidationGroups\ValidationGroups', $validationGroups);
    }

    public function testValidationGroupsFromYml()
    {
        if (!class_exists('Symfony\Component\Yaml\Yaml')) {
            $this->markTestSkipped();
        }

        $validationGroups = ValidationGroupsFactory::build(new YamlParserStrategy(
            __DIR__ . '/../../Resources/config/validation.yml'
        ));
        $this->assertInstanceOf('Melody\Validation\ValidationGroups\ValidationGroups', $validationGroups);
    }

    public function testValidationGroupsImportFileNotFound()
    {
        if (!class_exists('Symfony\Component\Yaml\Yaml')) {
            $this->markTestSkipped();
        }

        $this->setExpectedException('Melody\Validation\Exceptions\InvalidFileException');
        $this->assertInstanceOf('Melody\Validation\Exceptions\InvalidFileException', ValidationGroupsFactory::build(
            new YamlParserStrategy("file/not/found")
        ));
    }

    public function testValidationGroupsImportFileNotReadable()
    {
        $this->setExpectedException('Melody\Validation\Exceptions\InvalidFileException');
        $this->assertInstanceOf('Melody\Validation\Exceptions\InvalidFileException', ValidationGroupsFactory::build(
            new YamlParserStrategy(__DIR__ . '/../../Resources/config/emptyNotReadable')
        ));
    }

    public function testValidationGroupsMethods()
    {
        $constraintsCollection = new ConstraintsCollection();
        $constraintsCollection->set('name', v::maxLength(50));
        $constraintsCollection->set('email', v::email()->maxLength(50));

        $validationGroups = new ValidationGroups();
        $validationGroups->add("registering", $constraintsCollection);

        $this->assertTrue($validationGroups->has("registering"));
        $this->assertInstanceOf(
            'Melody\Validation\Common\Collections\ConstraintsCollection',
            $validationGroups->get("registering")
        );

        $validationGroups->remove("registering");
        $this->assertFalse($validationGroups->has("registering"));

        $this->setExpectedException('InvalidArgumentException');
        $this->assertInstanceOf('InvalidArgumentException', $validationGroups->get("registering"));
    }

    public function testValidationGroupsImportNotAcceptedFileFormat()
    {
        $this->setExpectedException('Melody\Validation\Exceptions\InvalidFileTypeException');
        $this->assertInstanceOf('Melody\Validation\Exceptions\InvalidFileTypeException', ValidationGroupsFactory::build(
            new YamlParserStrategy(__DIR__ . '/../../Resources/config/validation.ini')
        ));
    }

     /**
     * @expectedException \Melody\Validation\Exceptions\InvalidInputException
     */
    public function testShouldThrowInvalidInputExceptionWhenFirstArgumentNotIsArray()
    {
        $validationGroups = ValidationGroupsFactory::build(new ArrayParserStrategy(array()));
        $this->assertInstanceOf('Melody\Validation\ValidationGroups\ValidationGroups', $validationGroups);

        $validationGroups->validate("string", "registering");
    }
}

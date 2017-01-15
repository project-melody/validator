<?php

namespace Melody\Validation;

use Melody\Validation\ValidationGroups\Parser\YamlParser;
use Melody\Validation\ValidationGroups\Parser\ArrayParser;
use Melody\Validation\ValidationGroups\Parser\PHPParser;
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

        $validationGroups = ValidationGroupsFactory::build(new ArrayParser($config));
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

        $validationGroups = ValidationGroupsFactory::build(new ArrayParser($config));
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
        $rules = '<?php
            use Melody\Validation\Validator as v;

            $config["registering"] = array(
                "name" => v::maxLength(50),
                "email" => v::email()->maxLength(50),
                "username" => v::length(6, 12)->alnum()->noWhitespace(),
                "password" => v::length(6, 12)->containsSpecial(1)->containsLetter(3)->containsDigit(2)->noWhitespace()
            );

            return $config;
        ';

        $rulesFile = tmpfile();
        fwrite($rulesFile, $rules);
        $pathInfo = stream_get_meta_data($rulesFile);
        $validationGroups = ValidationGroupsFactory::build(new PHPParser(
            $pathInfo["uri"]
        ));

        $this->assertInstanceOf('Melody\Validation\ValidationGroups\ValidationGroups', $validationGroups);
    }

    public function testValidationGroupsFromYaml()
    {
        $rules = 'registering:
            name: "maxLength:50"
            email: "email|maxLength:50"
            username: "length:6:12|alnum|noWhitespace"
            password : "length:6:12|containsSpecial:1|containsLetter:3|containsDigit:2|noWhitespace"
        ';

        $rulesFile = tmpfile();
        fwrite($rulesFile, $rules);
        $pathInfo = stream_get_meta_data($rulesFile);

        $validationGroups = ValidationGroupsFactory::build(new YamlParser(
            $pathInfo["uri"]
        ));

        $this->assertInstanceOf('Melody\Validation\ValidationGroups\ValidationGroups', $validationGroups);
    }

    /**
     * @expectedException \Symfony\Component\Yaml\Exception\ParseException
     */
    public function testValidationGroupsFromInvalidYaml()
    {
        $rules = '
            invalid:
        ';

        $rulesFile = tmpfile();
        fwrite($rulesFile, $rules);
        $pathInfo = stream_get_meta_data($rulesFile);

        ValidationGroupsFactory::build(new YamlParser(
            $pathInfo["uri"]
        ));
    }

    public function testValidationGroupsImportFileNotFound()
    {
        if (!class_exists('Symfony\Component\Yaml\Yaml')) {
            $this->markTestSkipped();
        }

        $this->setExpectedException('Melody\Validation\Exceptions\InvalidFileException');
        $this->assertInstanceOf('Melody\Validation\Exceptions\InvalidFileException', ValidationGroupsFactory::build(
            new YamlParser("file/not/found")
        ));
    }

    public function testValidationGroupsImportFileNotReadable()
    {
        $this->setExpectedException('Melody\Validation\Exceptions\InvalidFileException');
        $this->assertInstanceOf('Melody\Validation\Exceptions\InvalidFileException', ValidationGroupsFactory::build(
            new YamlParser(__DIR__ . '/../../Resources/config/emptyNotReadable')
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

    /**
     * @expectedException \Melody\Validation\Exceptions\InvalidInputException
     */
    public function testShouldThrowInvalidInputExceptionWhenFirstArgumentNotIsArray()
    {
        $validationGroups = ValidationGroupsFactory::build(new ArrayParser(array()));
        $this->assertInstanceOf('Melody\Validation\ValidationGroups\ValidationGroups', $validationGroups);

        $validationGroups->validate("string", "registering");
    }
}

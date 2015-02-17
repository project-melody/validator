<?php

namespace Melody\Validation;

use Melody\Validation\ValidationObject\ArrayParserObject;
use Melody\Validation\ValidationGroups\ValidationGroupsFactory;
use Melody\Validation\Validator as v;

class Mock
{
    private $name;

    public $lastName;

    private $creditCard = "unaccessible";

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

class ValidationObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnTrueWhenSimpleObjectValidUsingGetterMethod()
    {
        $mock = new Mock();
        $mock->setName("pedro");

        $config['registering'] = array(
            'name' => v::maxLength(50),
        );

        $validationObject = ValidationGroupsFactory::build(new ArrayParserObject($config));
        $result = $validationObject->validate($mock, "registering");
        $this->assertTrue($result);
    }

    public function testShouldReturnTrueWhenSimpleObjectValidUsingAttributeDirectly()
    {
        $mock = new Mock();
        $mock->lastName = "ribeiro";

        $config['registering'] = array(
            'lastName' => v::maxLength(50),
        );

        $validationObject = ValidationGroupsFactory::build(new ArrayParserObject($config));
        $result = $validationObject->validate($mock, "registering");
        $this->assertTrue($result);
    }

    public function testShouldReturnTrueWhenSimpleObjectValidUsingAttributeDirectlyAndGetterMethod()
    {
        $mock = new Mock();
        $mock->lastName = "ribeiro";
        $mock->setName("pedro");

        $config['registering'] = array(
            'lastName' => v::maxLength(50),
        );

        $validationObject = ValidationGroupsFactory::build(new ArrayParserObject($config));
        $result = $validationObject->validate($mock, "registering");
        $this->assertTrue($result);
    }

    /**
     * @expectedException \Melody\Validation\Exceptions\InvalidInputException
     */
    public function testShouldThrowInvalidInputExceptionBecauseAttributeUnaccessible()
    {
        $mock = new Mock();

        $config['registering'] = array(
            'creditCard' => v::maxLength(50),
        );

        $validationObject = ValidationGroupsFactory::build(new ArrayParserObject($config));
        $validationObject->validate($mock, "registering");
    }

    public function testShouldReturnFalseWhenSimpleObjectInvalidUsingGetterMethod()
    {
        $mock = new Mock();
        $mock->setName("pedro");

        $config['registering'] = array(
            'name' => v::maxLength(1),
        );

        $validationObject = ValidationGroupsFactory::build(new ArrayParserObject($config));
        $result = $validationObject->validate(
            $mock,
            "registering",
            array(
            'name' => "'{{input}}' invalid name"
            )
        );
        $errors = $validationObject->getViolations();
        $this->assertFalse($result);
        $this->assertEquals("'{{input}}' invalid name", $errors["name"]);
    }
}

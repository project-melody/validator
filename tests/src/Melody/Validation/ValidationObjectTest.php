<?php

use Melody\Validation\ValidationObject\ArrayParserObjectStrategy;
use Melody\Validation\ValidationGroups\ValidationGroupsFactory;
use Melody\Validation\Validator as v;




class ValidationObjectTest extends \PHPUnit_Framework_TestCase
{
	public function test_should_return_true_when_simple_object_valid_using_getter_method()
	{
		$mock = new Mock();
		$mock->setName("pedro");

		$config['registering'] = array(
        	'name' => v::maxLength(50),
		);

		$validationObject = ValidationGroupsFactory::build(new ArrayParserObjectStrategy($config));
		$result = $validationObject->validate($mock, "registering");
		$this->assertTrue($result);
	}

	public function test_should_return_true_when_simple_object_valid_using_attribute_directly()
	{
		$mock = new Mock();
		$mock->lastName = "ribeiro";

		$config['registering'] = array(
        	'lastName' => v::maxLength(50),
		);

		$validationObject = ValidationGroupsFactory::build(new ArrayParserObjectStrategy($config));
		$result = $validationObject->validate($mock, "registering");
		$this->assertTrue($result);
	}

	public function test_should_return_true_when_simple_object_valid_using_attribute_directly_and_getter_method()
	{
		$mock = new Mock();
		$mock->lastName = "ribeiro";
		$mock->setName("pedro");

		$config['registering'] = array(
        	'lastName' => v::maxLength(50),
		);

		$validationObject = ValidationGroupsFactory::build(new ArrayParserObjectStrategy($config));
		$result = $validationObject->validate($mock, "registering");
		$this->assertTrue($result);
	}

	/**
	 * @expectedException \Melody\Validation\Exceptions\InvalidInputException
	 */
	public function test_should_throw_invalid_input_exception_because_attribute_unaccessible()
	{
		$mock = new Mock();

		$config['registering'] = array(
        	'creditCard' => v::maxLength(50),
		);

		$validationObject = ValidationGroupsFactory::build(new ArrayParserObjectStrategy($config));
		$validationObject->validate($mock, "registering");
	}

	public function test_should_return_false_when_simple_object_invalid_using_getter_method()
	{
		$mock = new Mock();
		$mock->setName("pedro");

		$config['registering'] = array(
        	'name' => v::maxLength(1),
		);

		$validationObject = ValidationGroupsFactory::build(new ArrayParserObjectStrategy($config));
		$result = $validationObject->validate($mock, "registering",array(
            'name' => "'{{input}}' invalid name"
        )
		);
		$errors = $validationObject->getViolations();
		$this->assertFalse($result);
		$this->assertEquals("'{{input}}' invalid name", $errors["name"]);
	}
}

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
<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidKeyException;
use Melody\Validation\Validator;

class ConstraintsCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function test_instanceof_validation_group_main()
    {
        $validator = new Validator();
        $validator->addConstraint(new EmailConstraint());

        $this->assertTrue($validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP) instanceof ConstraintsCollection);
    }

    public function test_instanceof_interator()
    {
    	$validator = new Validator();
    	$validator->addConstraint(new EmailConstraint());

    	$this->assertTrue($validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP)->getIterator() instanceof \ArrayIterator);
    }

    public function test_count()
    {
    	$validator = new Validator();
    	$validator->addConstraint(new EmailConstraint());

    	$this->assertEquals(1, $validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP)->count());
    }

    public function test_add_with_key()
    {
    	$validator = new Validator();
    	$validator->addConstraint(new EmailConstraint(), BaseConstraint::DEFAULT_GROUP, "email");

    	$this->assertTrue($validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP)->get("email") instanceof Validatable);
    }

    public function test_remove()
    {
    	$validator = new Validator();
    	$validator->addConstraint(new EmailConstraint(), BaseConstraint::DEFAULT_GROUP, "email");
    	$this->assertTrue($validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP)->get("email") instanceof Validatable);

    	$validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP)->remove("email");
    	$this->assertTrue(!$validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP)->exists("email"));

    }

	public function test_get_non_existent_key_exception()
    {
    	$validator = new Validator();

    	try {
    		$this->assertTrue($validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP)->get("email") instanceof Validatable);
    	} catch (\Exception $e) {
    		$this->assertEquals("Melody\Validation\Exceptions\InvalidKeyException", get_class($e));
    	}
    }

    public function test_remove_non_existent_key_exception()
    {
    	$validator = new Validator();

    	try {
    		$this->assertTrue($validator->getValidationGroups()->get(BaseConstraint::DEFAULT_GROUP)->remove("email") instanceof Validatable);
    	} catch (\Exception $e) {
    		$this->assertEquals("Melody\Validation\Exceptions\InvalidKeyException", get_class($e));
    	}
    }

}

<?php

namespace Melody\Validation;

use Melody\Validation\Constraints\BaseConstraint;

use Melody\Validation\Constraints\Validatable;
use Melody\Validation\Constraints\EmailConstraint;
use Melody\Validation\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
	public function test_add_constraint()
	{
		$validator = new Validator();

		$this->assertTrue($validator->addConstraint(new EmailConstraint()) instanceof Validator);
	}
}

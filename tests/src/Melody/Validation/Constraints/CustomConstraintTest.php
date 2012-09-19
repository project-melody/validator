<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Constraints\CustomConstraint;
use Melody\Validation\Validator;

class CustomConstraintTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_custom_sum()
    {
        $callback = function($number1, $number2, $total) {
            if ($number1 + $number2 == $total) {
                return true;
            } else {
                return false;
            }
        };

        $customConstraint = new CustomConstraint($callback);

        $this->assertTrue($customConstraint->validate(array(5, 4, 9)));
        $this->assertTrue($customConstraint->validate(array(5000, 5000, 10000)));
        $this->assertFalse($customConstraint->validate(array(5000, 5000, 0)));

    }

    public function test_list_violations()
    {
        $validator = new Validator();

        $callback = function($number1, $number2) {
            return $number1 + $number2;
        };

        $customConstraint = new CustomConstraint($callback);

        $validator->addConstraint($customConstraint);
        $validator->validate(array(5, 4, 4));
        var_dump($validator->getViolations());
    }

}

<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class Int extends Constraint implements Validatable
{
    protected $id = 'int';

    public function validate($input)
    {
        return (is_int($input));
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be an integer";
    }
}

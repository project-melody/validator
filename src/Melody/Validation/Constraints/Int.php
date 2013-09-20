<?php
namespace Melody\Validation\Constraints;

class Int extends Constraint
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

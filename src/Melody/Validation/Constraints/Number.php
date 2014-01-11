<?php
namespace Melody\Validation\Constraints;

class Number extends Constraint implements Validatable
{
    protected $id = 'number';

    public function validate($input)
    {
        return (is_numeric($input));
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be a number";
    }
}

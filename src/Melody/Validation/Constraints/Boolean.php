<?php
namespace Melody\Validation\Constraints;

class Boolean extends Constraint
{
    protected $id = 'boolean';

    public function validate($input)
    {
        return (is_bool($input));
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be boolean";
    }
}

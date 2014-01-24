<?php
namespace Melody\Validation\Constraints;

class Object extends Constraint
{
    protected $id = 'object';

    public function validate($input)
    {
        return is_object($input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be an object";
    }
}

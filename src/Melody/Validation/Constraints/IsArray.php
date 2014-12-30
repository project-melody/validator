<?php
namespace Melody\Validation\Constraints;

class IsArray extends Constraint
{
    protected $id = 'isArray';

    public function validate($input)
    {
        return (
            is_array($input)
            || $input instanceof \Traversable
            || $input instanceof \ArrayAccess
            || $input instanceof \ArrayObject
        );
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be an array";
    }
}

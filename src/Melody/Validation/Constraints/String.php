<?php
namespace Melody\Validation\Constraints;

class String extends Constraint
{
    protected $id = 'string';

    public function validate($input)
    {
        return (is_string($input));
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be an string";
    }
}

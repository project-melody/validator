<?php
namespace Melody\Validation\Constraints;

class Email extends Constraint
{
    protected $id = 'email';

    public function validate($input)
    {
        return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be a valid email";
    }
}

<?php
namespace Melody\Validation\Constraints;

class Email extends Constraint
{
    public function validate($input)
    {
        return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }

    public function getErrorMessageTemplate()
    {
        return "{{input}} must be a valid email";
    }
}

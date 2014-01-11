<?php
namespace Melody\Validation\Constraints;

class Email extends Constraint
{
    protected $id = 'email';

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new \InvalidArgumentException("The input field must be a string");
        }

        return filter_var($input, FILTER_VALIDATE_EMAIL);
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be a valid email";
    }
}

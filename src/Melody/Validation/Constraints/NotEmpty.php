<?php
namespace Melody\Validation\Constraints;

class NotEmpty extends Constraint
{
    protected $id = 'notEmpty';

    public function validate($input)
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return !empty($input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input must not be empty";
    }
}

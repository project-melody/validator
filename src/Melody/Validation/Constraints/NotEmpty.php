<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class NotEmpty extends Constraint implements Validatable
{
    protected $id = 'notEmpty';

    public function validate($input)
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return ($input !== "" || $input !== NULL);
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must not be empty";
    }
}

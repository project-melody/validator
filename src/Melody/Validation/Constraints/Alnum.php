<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class Alnum extends Constraint implements Validatable
{
    protected $id = 'alnum';

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new \InvalidArgumentException("The input field must be a string");
        }

        return preg_match('/^[a-zA-Z0-9]+$/', $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be alpha-numeric";
    }

}

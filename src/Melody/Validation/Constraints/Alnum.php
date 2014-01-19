<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidInputException;

class Alnum extends Constraint
{
    protected $id = 'alnum';

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new InvalidInputException("The input must be a string");
        }

        return preg_match('/^[a-zA-Z0-9]+$/', $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be alpha-numeric";
    }
}

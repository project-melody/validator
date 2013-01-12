<?php
namespace Melody\Validation\Constraints;

class Alnum extends Constraint
{
    public function validate($input)
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be alpha-numeric";
    }
}

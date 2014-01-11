<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class String extends Constraint implements Validatable
{
    protected $id = 'string';

    public function validate($input)
    {
        return (is_string($input));
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be an string";
    }
}

<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class NoWhitespace extends Constraint implements Validatable
{
    protected $id = 'noWhitespace';

    public function validate($input)
    {
        return !preg_match('/\s/', $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must not have whitespaces";
    }
}

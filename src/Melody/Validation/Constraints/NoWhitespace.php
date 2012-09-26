<?php
namespace Melody\Validation\Constraints;

class NoWhitespace extends Constraint
{
    public function validate($input)
    {
        return !preg_match('/\s/', $input);
    }

    public function getErrorMessageTemplate()
    {
        return "{{input}} must not have whitespaces";
    }
}

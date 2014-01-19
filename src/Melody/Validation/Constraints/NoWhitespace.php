<?php
namespace Melody\Validation\Constraints;

class NoWhitespace extends Constraint
{
    protected $id = 'noWhitespace';

    public function validate($input)
    {
        return !preg_match('/\s/', $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input must not have whitespaces";
    }
}

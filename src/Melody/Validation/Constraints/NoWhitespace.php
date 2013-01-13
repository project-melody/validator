<?php
namespace Melody\Validation\Constraints;

class NoWhitespace extends Constraint
{
    public function getId()
    {
        return 'noWhitespace';
    }

    public function validate($input)
    {
        return !preg_match('/\s/', $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must not have whitespaces";
    }
}

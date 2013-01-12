<?php
namespace Melody\Validation\Constraints;

class ContainsDigit extends Constraint
{
    private $min;
    public function __construct($min = 1)
    {
        if (!is_numeric($min)) {
            throw new \Exception("Min must be a number");
        }

        $this->min = $min;
    }

    public function validate($input)
    {
        return preg_match_all('/\d{1}/', $input, $matches) >= $this->min;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must contain at least {$this->min} digit(s)";
    }
}

<?php
namespace Melody\Validation\Constraints;

class ContainsSpecial extends Constraint
{
    private $min;
    public function __construct($min = 1)
    {
        if (!is_numeric($min)) {
            throw new \Exception("Min must be a number");
        }

        $this->min = $min;
    }

    public function getId()
    {
        return 'containsSpecial';
    }

    public function validate($input)
    {
        return preg_match_all('/[^a-zA-Z\d]{1}/', $input, $matches) >= $this->min;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must contain at least {$this->min} special char(s)";
    }
}

<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class ContainsSpecial extends Constraint implements Validatable
{
    protected $id = 'containsSpecial';
    private $min;

    public function __construct($min = 1)
    {
        if (!is_numeric($min)) {
            throw new \InvalidArgumentException("Min must be a number");
        }

        $this->min = $min;
    }

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new \InvalidArgumentException("The input field must be a string");
        }

        return preg_match_all('/[^a-zA-Z\d]{1}/', $input, $matches) >= $this->min;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must contain at least {$this->min} special char(s)";
    }
}

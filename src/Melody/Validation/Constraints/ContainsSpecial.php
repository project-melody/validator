<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;

class ContainsSpecial extends Constraint
{
    protected $id = 'containsSpecial';
    private $min;

    public function __construct($min = 1)
    {
        if (!is_numeric($min)) {
            throw new InvalidParameterException("Min must be a number");
        }

        $this->min = $min;
    }

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new InvalidInputException("The input field must be a string");
        }

        return preg_match_all('/[^a-zA-Z\d]{1}/', $input, $matches) >= $this->min;
    }

    public function getErrorMessageTemplate()
    {
        return "The input must contain at least {$this->min} special char(s)";
    }
}

<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;

class MinLength extends Constraint
{
    protected $id = 'minLength';
    private $minLength;

    public function __construct($minLength)
    {
        if (!is_numeric($minLength)) {
            throw new InvalidParameterException("The argument min length must be a number");
        }

        $this->minLength = $minLength;
    }

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new InvalidInputException("The input field must be a string");
        }

        return strlen($input) >= $this->minLength;
    }

    public function getErrorMessageTemplate()
    {
        return "The input must have at least {$this->minLength} characteres";
    }
}

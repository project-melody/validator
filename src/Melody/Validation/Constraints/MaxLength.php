<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;

class MaxLength extends Constraint
{
    protected $id = 'maxLength';
    private $maxLength;

    public function __construct($maxLength)
    {
        if (!is_numeric($maxLength)) {
            throw new InvalidParameterException("The max length argument must be numeric");
        }

        $this->maxLength = $maxLength;
    }

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new InvalidInputException("The input field must be a string");
        }

        return strlen($input) <= $this->maxLength;
    }

    public function getErrorMessageTemplate()
    {
        return "The input must have at maximum {$this->maxLength} characteres";
    }
}

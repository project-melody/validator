<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;

class Length extends Constraint
{
    protected $id = 'length';
    private $minLength;
    private $maxLength;

    /**
     * @param  Int                                                     $min
     * @param  Int                                                     $max
     * @throws \Melody\Validation\Exceptions\InvalidParameterException
     */
    public function __construct($min, $max)
    {
        if (!is_numeric($min) || !is_numeric($max)) {
            throw new InvalidParameterException("The min and max arguments must be numeric");
        }

        $this->minLength = $min;
        $this->maxLength = $max;
    }

    /**
     * @param  string                                              $input
     * @return bool
     * @throws \Melody\Validation\Exceptions\InvalidInputException
     */
    public function validate($input)
    {
        if (!is_string($input)) {
            throw new InvalidInputException("The input field must be a string");
        }

        return strlen($input) >= $this->minLength && strlen($input) <= $this->maxLength;
    }

    public function getErrorMessageTemplate()
    {
        return "The input must have at least {$this->minLength} and at maximun {$this->maxLength} characteres";
    }
}

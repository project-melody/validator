<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class Length extends Constraint implements Validatable
{
    protected $id = 'length';
    private $minLength;
    private $maxLength;

    /**
     * @param Int $minLength
     * @param Int $maxLength
     * @throws \InvalidArgumentException
     */
    public function __construct($minLength, $maxLength)
    {
        if (!is_numeric($minLength)) {
            throw new \InvalidArgumentException("It is necessary to define the length");
        }

        if (!is_null($maxLength) && !is_numeric($maxLength)) {
            throw new \InvalidArgumentException("The max length must be a number");
        }

        if (!is_null($maxLength)) {
            $this->minLength = $minLength;
            $this->maxLength = $maxLength;
        }
    }

    public function validate($input)
    {
        if (is_null($input)) {
            return false;
        }

        if (!is_string($input)) {
            throw new \InvalidArgumentException("The input field must be a string");
        }

        return strlen($input) >= $this->minLength && strlen($input) <= $this->maxLength;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must have at least {$this->minLength} and at maximun {$this->maxLength} characteres";
    }
}

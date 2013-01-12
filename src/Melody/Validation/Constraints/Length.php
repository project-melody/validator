<?php
namespace Melody\Validation\Constraints;

class Length extends Constraint
{
    private $minLength;
    private $maxLength;
    private $exactLength;

    /**
     * @param Int $length
     * @param Int $maxLength
     * @throws \Exception
     */
    public function __construct($length, $maxLength = null)
    {
        if (!is_numeric($length)) {
            throw new \Exception("It is necessary to define the length");
        }

        if (!is_null($maxLength) && !is_numeric($maxLength)) {
            throw new \Exception("The max length must be a number");
        }

        if (!is_null($maxLength)) {
            $this->minLength = $length;
            $this->maxLength = $maxLength;
        } else {
            $this->exactLength = $length;
        }
    }

    public function validate($input)
    {
        if (is_null($input)) {
            return false;
        }

        if (!is_string($input)) {
            throw new \Exception("The input field must be a string");
        }

        if (is_numeric($this->exactLength)) {
            return strlen($input) == $this->exactLength;
        }

        if (is_numeric($this->maxLength)) {
            return strlen($input) >= $this->minLength && strlen($input) <= $this->maxLength;
        } else {
            return strlen($input) >= $this->minLength;
        }
    }

    public function getErrorMessageTemplate()
    {
        if (is_numeric($this->exactLength)) {
            return "The input '{{input}}' must have {$this->exactLength} and characteres";
        }

        if (is_numeric($this->maxLength)) {
            return "The input '{{input}}' must have at least {$this->minLength} and at maximun {$this->maxLength} characteres";
        } else {
            return "The input '{{input}}' must have at least {$this->minLength} characteres";
        }
    }
}

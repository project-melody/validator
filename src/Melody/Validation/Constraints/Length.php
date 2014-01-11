<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class Length extends Constraint implements Validatable
{
    protected $id = 'length';
    private $minLength;
    private $maxLength;

    /**
     * @param Int $min
     * @param Int $max
     * @throws \InvalidArgumentException
     */
    public function __construct($min, $max)
    {
        if (!is_numeric($min) || !is_numeric($max)) {
            throw new \InvalidArgumentException("The min and max arguments must be numeric");
        }

        $this->minLength = $min;
        $this->maxLength = $max;
    }

    public function validate($input)
    {
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

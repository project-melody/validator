<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class MaxLength extends Constraint implements Validatable
{
    protected $id = 'maxLength';
    private $maxLength;

    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function validate($input)
    {
        if (!is_string($input)) {
            throw new \InvalidArgumentException("The input field must be a string");
        }

        return strlen($input) <= $this->maxLength;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must have at maximum {$this->maxLength} characteres";
    }
}

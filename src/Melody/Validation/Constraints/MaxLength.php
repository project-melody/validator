<?php
namespace Melody\Validation\Constraints;

class MaxLength extends Constraint
{
    private $maxLength;
    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function getId()
    {
        return 'maxLength';
    }

    public function validate($input)
    {
        return is_string($input) && strlen($input) <= $this->maxLength;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must have at maximum {$this->maxLength} characteres";
    }
}

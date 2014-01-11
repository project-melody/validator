<?php
namespace Melody\Validation\Constraints;

class MinLength extends Constraint
{
    protected $id = 'minLength';
    private $minLength;

    public function __construct($minLength)
    {
        $this->minLength = $minLength;
    }

    public function validate($input)
    {
        return is_string($input) && strlen($input) >= $this->minLength;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must have at least {$this->minLength} characteres";
    }
}

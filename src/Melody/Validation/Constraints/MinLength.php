<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class MinLength extends Constraint implements Validatable
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

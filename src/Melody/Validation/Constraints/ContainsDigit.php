<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class ContainsDigit extends Constraint implements Validatable
{
    protected $id = 'containsDigit';
    private $min;

    public function __construct($min)
    {
        if (!is_numeric($min)) {
            throw new \InvalidArgumentException("Min must be a number");
        }

        $this->min = $min;
    }

    public function validate($input)
    {
        return preg_match_all('/\d{1}/', $input, $matches) >= $this->min;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must contain at least {$this->min} digit(s)";
    }
}

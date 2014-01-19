<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;

class Min extends Constraint
{
    protected $id = 'min';
    private $min;

    public function __construct($min)
    {
        if (!is_numeric($min)) {
            throw new InvalidParameterException("The min argument must be numeric");
        }

        $this->min = $min;
    }

    public function validate($input)
    {
        if (!is_numeric($input)) {
            throw new InvalidInputException("The max length must be a number");
        }

        return $input >= $this->min;
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be lower than {$this->min}";
    }
}

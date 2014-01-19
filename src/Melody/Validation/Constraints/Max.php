<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;

class Max extends Constraint
{
    protected $id = 'max';
    private $max;

    public function __construct($max)
    {
        if (!is_numeric($max)) {
            throw new InvalidParameterException("The max argument must be numeric");
        }

        $this->max = $max;
    }

    public function validate($input)
    {
        if (!is_numeric($input)) {
            throw new InvalidInputException("The max length must be a number");
        }

        return $input <= $this->max;
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be greater than {$this->max}";
    }
}

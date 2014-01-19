<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;

class Range extends Constraint
{
    protected $id = 'range';
    private $min;
    private $max;

    /**
     * @param  Int                                                     $min
     * @param  Int                                                     $max
     * @throws \Melody\Validation\Exceptions\InvalidParameterException
     */
    public function __construct($min, $max)
    {
        if (!is_numeric($min)) {
            throw new InvalidParameterException("The argument min must be a number");
        }

        if (!is_numeric($max)) {
            throw new InvalidParameterException("The argument max be a number");
        }

        $this->min = $min;
        $this->max = $max;
    }

    public function validate($input)
    {
        if (!is_numeric($input)) {
            throw new InvalidInputException("The input field must be a number");
        }

        return filter_var(
            $input,
            FILTER_VALIDATE_INT,
            array(
                'options' => array('min_range' => $this->min, 'max_range' => $this->max)
            )
        );
    }

    public function getErrorMessageTemplate()
    {
        return "The number must be between {$this->min} and {$this->max}";
    }
}

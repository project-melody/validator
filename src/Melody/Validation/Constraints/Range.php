<?php
namespace Melody\Validation\Constraints;

class Range extends Constraint
{
    protected $id = 'range';
    private $min;
    private $max;

    /**
     * @param Int $min
     * @param Int $max
     * @throws \Exception
     */
    public function __construct($min, $max)
    {
        if (!is_int($min)) {
            throw new \Exception("It is necessary to define the min as integer");
        }

        if (!is_int($max)) {
            throw new \Exception("It is necessary to define the max as integer");
        }

        $this->min = $min;
        $this->max = $max;
    }

    public function validate($input)
    {
        if (!is_int($input)) {
            throw new \Exception("The input field must be a integer");
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
        return "The number '{{input}}' must be between {$this->min} and {$this->max}";
    }
}

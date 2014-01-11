<?php
namespace Melody\Validation\Constraints;

class Min extends Constraint
{
    protected $id = 'min';
    private $min;

    public function __construct($min)
    {
        $this->min = $min;
    }

    public function validate($input)
    {
        if (!is_numeric($input)) {
            throw new \InvalidArgumentException("The max length must be a number");
        }

        return $input >= $this->min;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be lower than {$this->min}";
    }
}

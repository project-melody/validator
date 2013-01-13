<?php
namespace Melody\Validation\Constraints;

class Min extends Constraint
{
    private $min;
    public function __construct($min)
    {
        $this->min = $min;
    }

    public function getId()
    {
        return 'min';
    }

    public function validate($input)
    {
        if (is_numeric($input) && $input >= $this->min)
            return true;
        else
            return false;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be lower than {$this->min}";
    }
}

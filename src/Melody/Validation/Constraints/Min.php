<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class Min extends Constraint implements Validatable
{
    protected $id = 'min';
    private $min;

    public function __construct($min)
    {
        $this->min = $min;
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

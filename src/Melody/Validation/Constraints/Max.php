<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

class Max extends Constraint implements Validatable
{
    protected $id = 'max';
    private $max;

    public function __construct($max)
    {
        $this->max = $max;
    }

    public function validate($input)
    {
        if (!is_numeric($input)) {
            throw new \InvalidArgumentException("The max length must be a number");
        }

        return $input <= $this->max;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be greater than {$this->max}";
    }
}

<?php
namespace Melody\Validation\Constraints;

class Min
{
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
}

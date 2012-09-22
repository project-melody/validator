<?php
namespace Melody\Validation\Constraints;

class Max
{
    private $max;
    public function __construct($max)
    {
        $this->max = $max;
    }
    
    public function validate($input)
    {
        return is_numeric($input) && $input <= $this->max;
    }
}

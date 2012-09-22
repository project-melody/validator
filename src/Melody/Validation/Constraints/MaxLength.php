<?php
namespace Melody\Validation\Constraints;

class MaxLength
{
    private $maxLength;
    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }
    
    public function validate($input)
    {
        return is_string($input) && strlen($input) <= $this->maxLength;
    }
}

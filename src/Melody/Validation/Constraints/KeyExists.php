<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidInputException;
use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Validator as v;

class KeyExists extends Constraint
{
    protected $id = 'keyExists';
    private $key;

    public function __construct($key)
    {
        if (!is_string($key)) {
            throw new InvalidParameterException("The key must be a string");
        }

        $this->key = $key;
    }

    public function validate($input)
    {
        if (!v::isArray()->validate($input)) {
            throw new InvalidInputException("The input must be an array");
        }

        return array_key_exists($this->key, $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The specified key does not exists";
    }
}

<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidInputException;
use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Validator as v;

class NotEmptyKey extends Constraint
{
    protected $id = 'notEmptyKey';
    private $key;

    public function __construct($key)
    {
        if (!v::string()->validate($key)) {
            throw new InvalidParameterException("The key must a string");
        }

        $this->key = $key;
    }

    public function validate($input)
    {
        if (!$this->isArray($input)) {
            throw new InvalidInputException("The input must be an array");
        }

        if (!$this->keyExists($this->key, $input)) {
            throw new InvalidInputException("The key does not exists");
        }

        return v::notEmpty()->validate($input[$this->key]);
    }

    public function getErrorMessageTemplate()
    {
        return "The key must not be empty";
    }

    public function isArray($input)
    {
        return v::isArray()->validate($input);
    }

    public function keyExists($key, $input)
    {
        return v::keyExists($key)->validate($input);
    }
}

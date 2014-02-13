<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;

class NotInstance extends Constraint
{
    protected $id = 'notInstance';
    private $instanceFQName;

    public function __construct($instanceFQName)
    {
        if (!is_string($instanceFQName)) {
            throw new InvalidParameterException("The class name must be a string");
        }

        $this->instanceFQName = $instanceFQName;
    }

    public function validate($input)
    {
        return !$input instanceof $this->instanceFQName;
    }

    public function getErrorMessageTemplate()
    {
        return "The input must not be an instance of {$this->instanceFQName}";
    }
}

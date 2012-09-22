<?php
namespace Melody\Validation;

use ReflectionClass;

class ConstraintsBuilder
{  
    private $constraints = array();
    
    private static function create()
    {
        $ref = new ReflectionClass(__CLASS__);
        
        return $ref->newInstanceArgs(func_get_args());
    }
    
    public static function __callStatic($name, $arguments=array())
    {
        return self::create()->add($name, $arguments);
    }
    
    public function __call($name, $arguments=array())
    {
        return $this->add($name, $arguments);
    }
    
    public function add($name, $arguments)
    {
        $constraintFqn = "Melody\\Validation\\Constraints\\" . ucfirst($name);
        $constraintClass = new ReflectionClass($constraintFqn);
        $constraintInstance = $constraintClass->newInstanceArgs($arguments);
        $this->constraints[] = $constraintInstance;
        
        return $this;
    }
    
    public function getConstraints()
    {
        return $this->constraints;
    }
    
    public function validate($input)
    {
        $validator = new Validator();
        
        return $validator->validate($input, $this);
    }
    
}

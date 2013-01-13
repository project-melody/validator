<?php
namespace Melody\Validation;

use ReflectionClass;
use Melody\Validation\Common\Collections\ConstraintsCollection;

class Validator
{
    private $constraints;
    private $violations = array();
    private $inputs = array();

    public function __construct()
    {
        $this->constraints = new ConstraintsCollection();
    }

    private static function create()
    {
        $ref = new ReflectionClass(__CLASS__);

        return $ref->newInstanceArgs(func_get_args());
    }

    public static function __callStatic($name, $arguments=array())
    {
        return self::create()->set($name, $arguments);
    }

    public function __call($name, $arguments=array())
    {
        return $this->set($name, $arguments);
    }

    public function set($name, $arguments)
    {
        $constraintFqn = "Melody\\Validation\\Constraints\\" . ucfirst($name);
        $constraintClass = new ReflectionClass($constraintFqn);
        $constraintInstance = $constraintClass->newInstanceArgs($arguments);

        if ($this->constraints->offsetExists($name)) {
            throw new \InvalidArgumentException("Constraint named {$name} already setted");
        }

        $this->constraints->set($name, $constraintInstance);

        return $this;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @return multitype:
     */
    public function getViolations($customMessages = array())
    {
        if (is_array($customMessages) && $customMessages != array()) {
            foreach ($this->violations as $id => $message) {
                if (isset($customMessages[$id])) {
                    $this->violations[$id] = $this->format($customMessages[$id], array('input' => $this->inputs[$id]));
                }
            }
        }

        return $this->violations;
    }

    public function add(Validator $validatorBuilder)
    {

        $builder = self::create();
        $builder->constraints = clone $this->constraints;

        $constraints = $validatorBuilder->getConstraints();
        if (count($constraints)) {
            foreach ($constraints as $name => $constraint) {
                $builder->constraints->set($name, $constraint);
            }
        }

        return $builder;
    }

    public function validate($input, $constraints = null)
    {
        if ($constraints instanceof Validator) {
            $validatorConstraints = $constraints->getConstraints();
        } else {
            $validatorConstraints = $this->getConstraints();
        }

        foreach ($validatorConstraints as $constraint) {
            if (!$constraint->validate($input)) {
                $this->reportError($constraint->getId(), $input, $constraint->getErrorMessageTemplate());
            }
        }

        return $this->isValid();
    }

    public function reportError($id, $input, $template)
    {
        $this->violations[$id] = $this->format($template, array('input' => $input));
        $this->inputs[$id] = $input;
    }

    /**
     * @param String $template
     * @param array $vars
     * @return mixed|unknown
     */
    public function format($template, array $vars=array())
    {
        return preg_replace_callback(
                '/{{(\w+)}}/',
                function($match) use($vars) {
            return isset($vars[$match[1]]) ? $vars[$match[1]] : $match[0];
        }, $template
        );
    }

    /**
     * @return Bool
     */
    public function isValid()
    {
        return is_array($this->violations) && count($this->violations) == 0;
    }

}

<?php
namespace Melody\Validation;

use ReflectionClass;
use Melody\Validation\Common\Collections\ConstraintsCollection;

/**
 * @method static Validator date($format = null)
 * @method static Validator isAfter($date, $format = null)
 * @method static Validator isBefore($date, $format = null)
 * @method static Validator isBetween($firstDate, $secondDate, $format = null)
 */
class Validator
{
    private $constraints;
    private $violations = [];
    private $inputs = [];

    public function __construct()
    {
        $this->constraints = new ConstraintsCollection();
    }

    /**
     * @return object
     */
    private static function create()
    {
        $ref = new ReflectionClass(__CLASS__);

        return $ref->newInstanceArgs(func_get_args());
    }

    /**
     * @param $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments = [])
    {
        return self::create()->set($name, $arguments);
    }

    /**
     * @param $name
     * @param array $arguments
     * @return Validator
     */
    public function __call($name, $arguments = [])
    {
        return $this->set($name, $arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function set($name, $arguments)
    {
        if (!$this->constraints->offsetExists($name)) {
            $constraintFqn = "Melody\\Validation\\Constraints\\" . ucfirst($name);
            $constraintClass = new ReflectionClass($constraintFqn);

            /** @var Validatable $constraintInstance */
            $constraintInstance = $constraintClass->newInstanceArgs($arguments);

            $this->registerConstraint($constraintInstance);
        }

        return $this;
    }

    /**
     * @param Validatable $constraint
     * @return $this
     */
    public function registerConstraint(Validatable $constraint)
    {
        if ($this->constraints->offsetExists($constraint->getId())) {
            throw new \InvalidArgumentException("The constraint named {$constraint->getId()} was already setted");
        }

        $this->constraints->set($constraint->getId(), $constraint);

        return $this;
    }

    /**
     * @return ConstraintsCollection
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @param array $customMessages
     * @return array
     */
    public function getViolations($customMessages = [])
    {
        if (is_array($customMessages) && $customMessages != []) {
            foreach ($this->violations as $id => $message) {
                if (isset($customMessages[$id])) {
                    $this->violations[$id] = $this->format($customMessages[$id], ['input' => $this->inputs[$id]]);
                }
            }
        }

        return $this->violations;
    }

    public function getViolation($id, $customMessage = null)
    {
        if (!array_key_exists($id, $this->violations)) {
            throw new \InvalidArgumentException("Id not found in validator");
        }

        if (!is_null($customMessage)) {
            return $this->format($customMessage, ['input' => $this->inputs[$id]]);
        }

        return $this->violations[$id];
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
        $this->violations[$id] = $this->format($template, ['input' => $input]);
        $this->inputs[$id] = $input;
    }

    /**
     * @param string $template
     * @param array $vars
     * @return mixed
     */
    public function format($template, array $vars = [])
    {
        return preg_replace_callback(
            '/{{(\w+)}}/',
            function ($match) use ($vars) {
                return isset($vars[$match[1]]) ? $vars[$match[1]] : $match[0];
            },
            $template
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

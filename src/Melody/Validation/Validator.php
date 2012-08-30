<?php

namespace Melody\Validation;

use Melody\Validation\Constraints\Validatable;
use Melody\Validation\Constraints\ConstraintsCollection;
use Melody\Validation\Constraints\EmailConstraint;
use Melody\Validation\Constraints\BaseConstraint;
use Melody\Validation\GroupsCollection;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
class Validator
{
	/**
	 * Collection of validation groups
	 * @var GroupsCollection
	 */
    protected $validationGroups;

    /**
	 * Violations list
	 * @var Array
     */
    protected $violations = array();

    public function __construct()
    {
        $this->validationGroups = new GroupsCollection();
        $this->validationGroups->add(new ConstraintsCollection(), "main");
    }

    public function getValidationGroups()
    {
    	return $this->validationGroups;
    }

    public function addConstraint(Validatable $constraint, $validationGroup = null, $constraintKey = null)
    {
    	if (is_array($validationGroup)) {
    		foreach ($validationGroup as $group) {
    			if (!$this->validationGroups->exists($group)) {
    				$this->validationGroups->add(new ConstraintsCollection(), $group);
    			}

    			$constraint->setValidationGroup($group);
    			if (!is_null($constraintKey)) {
    				$this->validationGroups->get($group)->add($constraint, $constraintKey);
    			} else {
    				$this->validationGroups->get($group)->add($constraint);
    			}

    		}
    	} else {
    		if (is_null($validationGroup)) {
    			$validationGroup = BaseConstraint::DEFAULT_GROUP;
    		}

    		if (!$this->validationGroups->exists($validationGroup)) {
   			    $this->validationGroups->add(new ConstraintsCollection(), $validationGroup);
   			}

            $constraint->setValidationGroup($validationGroup);
    		if (!is_null($constraintKey)) {
    				$this->validationGroups->get($validationGroup)->add($constraint, $constraintKey);
    			} else {
    				$this->validationGroups->get($validationGroup)->add($constraint);
    			}
    		}

        return $this;
    }

    public function validate($input, $group = "main")
    {
        $valid = true;

        if ($group && !$this->validationGroups->exists($group)) {
            throw new \Exception("Group {$group} does not exists");
        }

        foreach($this->validationGroups->get($group) as $constraints) {
            foreach ($constraints as $constraint) {
                if (!$constraint->validate($input)) {
                    $this->violations[] = $this->format($constraint->getErrorMessageTemplate(), array('input' => $input));
                    $valid = false;
                }
            }
        }

        return $valid;
    }

    public function getViolations()
    {
        return $this->violations;
    }

    public function format($template, array $vars=array())
    {
        return preg_replace_callback(
                '/{{(\w+)}}/',
                function($match) use($vars) {
                    return isset($vars[$match[1]]) ? $vars[$match[1]] : $match[0];
                }, $template
        );
    }

}

<?php

/*
 * This file is distributed under BSD licence.
 */

namespace Melody\Validation;

use Melody\Validation\Constraints\ConstraintsInterface;
use Melody\Validation\Constraints\ConstraintsCollection;
use Melody\Validation\Constraints\EmailConstraint;
use Melody\Validation\GroupsCollection;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
class Validator
{
    protected $groups;
    protected $errorMessages = array();

    public function __construct()
    {
        $this->groups = new GroupsCollection();
        $this->groups->add(new ConstraintsCollection(), "main");
    }

    public function addConstraint($criteria, $group = null)
    {
        $constraints = array();

        if (is_null($group)) {
            $group = "main";
        }

        foreach ($criteria['constraints'] as $constraint) {
            $constraints[] = $constraint;
        }

        if (count($constraints) > 0) {
            $this->groups->get($group)->add($constraints);
        } else {
            throw new \Exception("It is necessary at least one constraint to validate");
        }

        return $this;
    }

    public function validate($input, $group = "main")
    {
        $valid = true;

        if ($group && !$this->groups->exists($group)) {
            throw new \Exception("Group {$group} does not exists");
        }

        foreach($this->groups->get($group) as $constraints) {
            foreach ($constraints as $constraint) {
                if (!$constraint->validate($input)) {
                    $valid = false;
                    $errorMessage = $this->format($constraint->getErrorMessageTemplate(), array('input' => $input));
                    $this->errorMessages[] = $errorMessage;

                    $valid = false;
                }
            }
        }

        return $valid;
    }

    public function getViolations()
    {
        return $this->errorMessages;
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

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

}

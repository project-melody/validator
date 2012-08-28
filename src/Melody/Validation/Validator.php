<?php

/*
 * This file is distributed under BSD licence.
 */

namespace Melody\Validation;

use Melody\Validation\Constraints\ConstraintsInterface;
use Melody\Validation\Constraints\ConstraintsCollection;
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

    public function addConstraint(ConstraintsInterface $constraint, $group = null)
    {
        if (is_null($group)) {
            $this->groups->get("main")->add($constraint);
        } else {
            $this->groups->get($group)->add($constraint);
        }

        return $this;
    }

    public function validate($input, $group = null)
    {
        $valid = false;
        if ($this->groups->exists($group)) {
            foreach($this->groups->get($group) as $constraintCollection) {
                foreach ($constraintCollection as $constraint) {
                    if (!$constraint->validate($input)) {
                        $valid = false;
                        $this->errorMessages[] = $constraint->getErrorMessage();
                    } else {
                        $valid = true;
                    }
                }
            }
        } else {
            throw new \Exception("Group {$group} does not exists");
        }

        return $valid;
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

}

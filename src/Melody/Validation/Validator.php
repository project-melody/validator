<?php

/*
 * This file is distributed under MIT licence.
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

    public function run()
    {

    }

}

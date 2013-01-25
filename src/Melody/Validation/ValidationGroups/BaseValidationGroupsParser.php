<?php

namespace Melody\Validation\ValidationGroups;

use Melody\Validation\Common\Collections\ConstraintsCollection;
use Melody\Validation\Validator;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
abstract class BaseValidationGroupsParser
{
    abstract public function parse();

    /**
     * @param array $constraints
     *
     * @return \Melody\Validation\Common\Collections\ConstraintsCollection
     */
    public function parseConstraints(array $constraints)
    {
        $constraintsCollection = new ConstraintsCollection();

        foreach ($constraints as $id => $constraint) {
            $constraintsCollection->set($id, $constraint);
        }

        return $constraintsCollection;
    }

    /**
     * @param string $string
     *
     * @return \Melody\Validation\ValidationGroups\Validator
     */
    public function parseString($string) {
        $validator = new Validator();

        $rules = explode("|", $string);
        foreach ($rules as $rule) {
            $parts = explode(":", $rule);
            $class = array_shift($parts);
            $options = $parts;

            $validator->set($class, $options);
        }

        return $validator;
    }

    /**
     * @param array $configuration
     */
    public function parseCofiguration(array $configuration)
    {
        $validationGroups = new ValidationGroups();

        foreach (array_keys($configuration) as $group) {
            $validationGroups->add($group, $this->parseConstraints($configuration[$group]));
        }

        return $validationGroups;
    }
}

<?php
namespace Melody\Validation\ValidationGroups;

use Melody\Validation\Common\Collections\ConstraintsCollection;

class ValidationGroups
{
    private $groups = array();
    private $violations = array();

    public function add($id, ConstraintsCollection $group)
    {
        $this->groups[$id] = $group;
    }

    public function get($id)
    {
        if (!isset($this->groups[$id])) {
            throw new \InvalidArgumentException("Group $id not found");
        }

        return $this->groups[$id];
    }

    public function remove($id)
    {
        unset($this->groups[$id]);
    }

    public function has($id)
    {
        return isset($this->groups[$id]);
    }

    public function validate(array $data, $group, $customMessages = array())
    {
        $constraints = $this->get($group);
        $valid = true;
        $this->violations = array();

        foreach ($data as $id => $input) {
            if ($constraints[$id] instanceof \Melody\Validation\Validator && !$constraints[$id]->validate($input)) {
                $valid = false;
                $this->violations = array_merge($this->violations, $constraints[$id]->getViolations($customMessages));
            }
        }

        return $valid;
    }

    public function getViolations()
    {
        return $this->violations;
    }
}

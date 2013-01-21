<?php
namespace Melody\Validation;

use Melody\Validation\Common\Collections\ConstraintsCollection;

class ValidationGroups
{
    private $groups = array();

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
}

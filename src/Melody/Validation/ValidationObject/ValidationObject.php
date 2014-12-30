<?php
namespace Melody\Validation\ValidationObject;

use Melody\Validation\Common\Collections\ConstraintsCollection;
use Melody\Validation\ValidationGroups\ValidationGroups;
use Melody\Validation\Exceptions\InvalidInputException;

class ValidationObject extends ValidationGroups
{

    public function validate($object, $group, $customMessages = array())
    {
        $constraints = $this->get($group);
        $valid = true;
        $this->violations = array();

        foreach ($constraints as $attributeName => $constraint) {
            $attributeValue = $this->getAttributeValue($object, $attributeName);
            $result = $constraint->validate($attributeValue);

            if (!$result) {
                $this->violations = array_merge($this->violations, $customMessages);
                $valid = false;
            }
        }

        return $valid;
    }

    /**
     * @param $object
     * @param $attributeName
     * @return mixed|InvalidInputException
     */
    protected function getAttributeValue($object, $attributeName)
    {
        $attributes = get_object_vars($object);

        if (array_key_exists($attributeName, $attributes)) {
            return $attributes[$attributeName];
        }

        $methods = get_class_methods($object);
        $getterName = $this->getGetterName($attributeName);
        if (in_array($getterName, $methods)) {
            return $object->{$getterName}();
        }

        throw new InvalidInputException("attribute {$attributeName} not exists");
    }

    /**
     * @param $attributeName
     * @return string
     */
    protected function getGetterName($attributeName)
    {
        return "get". ucwords($attributeName);
    }
}

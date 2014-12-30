<?php

namespace Melody\Validation\ValidationObject;

use Melody\Validation\ValidationGroups\ArrayParserStrategy;
use Melody\Validation\ValidationObject\ValidationObject;

class ArrayParserObjectStrategy extends ArrayParserStrategy
{

    public function parse()
    {
        $validationObject = new ValidationObject();

        foreach (array_keys($this->configuration) as $group) {
            $validationObject->add($group, $this->parseConstraints($this->configuration[$group]));
        }

        return $validationObject;
    }
}

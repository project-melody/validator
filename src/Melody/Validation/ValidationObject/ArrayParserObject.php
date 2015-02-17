<?php

namespace Melody\Validation\ValidationObject;

use Melody\Validation\ValidationGroups\Parser\ArrayParser;
use Melody\Validation\ValidationObject\ValidationObject;

class ArrayParserObject extends ArrayParser
{
    /**
     * @return ValidationObject
     */
    public function parse()
    {
        $validationObject = new ValidationObject();

        foreach (array_keys($this->configuration) as $group) {
            $validationObject->add($group, $this->parseConstraints($this->configuration[$group]));
        }

        return $validationObject;
    }
}

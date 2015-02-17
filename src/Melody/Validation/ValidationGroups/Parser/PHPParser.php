<?php

namespace Melody\Validation\ValidationGroups\Parser;

use Melody\Validation\ValidationGroups\AbstractValidationGroupsFileParser;
use Melody\Validation\ValidationGroups\ValidationGroups;

class PHPParser extends AbstractValidationGroupsFileParser
{
    /**
     * @return \Melody\Validation\ValidationGroups
     */
    public function parse()
    {
        $configuration = require $this->file['dirname'].'/'.$this->file['basename'];

        return $this->parseCofiguration($configuration);
    }

    /**
     * @param array $configuration
     * @return ValidationGroups
     */
    protected function parseCofiguration(array $configuration)
    {
        $validationGroups = new ValidationGroups();

        foreach (array_keys($configuration) as $group) {
            $validationGroups->add($group, $this->parseConstraints($configuration[$group]));
        }

        return $validationGroups;
    }
}

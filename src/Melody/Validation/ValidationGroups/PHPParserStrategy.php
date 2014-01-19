<?php

namespace Melody\Validation\ValidationGroups;

class PHPParserStrategy extends AbstractValidationGroupsFileParser
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

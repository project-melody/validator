<?php

namespace Melody\Validation\ValidationGroups;

use Melody\Validation\ValidationGroups\ValidationGroupsArrayParserInterface;

class ArrayParserStrategy extends AbstractValidationGroupsParser
{
    protected $configuration;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    public function parse()
    {
        $validationGroups = new ValidationGroups();

        foreach (array_keys($this->configuration) as $group) {
            $validationGroups->add($group, $this->parseConstraints($this->configuration[$group]));
        }

        return $validationGroups;
    }
}

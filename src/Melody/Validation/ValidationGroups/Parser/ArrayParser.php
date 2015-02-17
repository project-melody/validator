<?php

namespace Melody\Validation\ValidationGroups\Parser;

use Melody\Validation\ValidationGroups\AbstractValidationGroupsParser;
use Melody\Validation\ValidationGroups\ValidationGroups;

class ArrayParser extends AbstractValidationGroupsParser
{
    /**
     * @var array
     */
    protected $configuration;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return ValidationGroups
     */
    public function parse()
    {
        $validationGroups = new ValidationGroups();

        foreach (array_keys($this->configuration) as $group) {
            $validationGroups->add($group, $this->parseConstraints($this->configuration[$group]));
        }

        return $validationGroups;
    }
}

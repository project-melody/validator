<?php

namespace Melody\Validation\ValidationGroups;

use Melody\Validation\ValidationGroups\AbstractValidationGroupsParser;
use Melody\Validation\Exceptions\InvalidFileTypeException;
use Symfony\Component\Yaml\Yaml;

class YamlParserStrategy extends AbstractValidationGroupsFileParser
{
    public function parse()
    {
        if (strtolower($this->file['extension']) != 'yml') {
            throw new InvalidFileTypeException("Extension '{$this->file['extension']}' is not allowed");
        }

        $constraints = array();
        $configuration = Yaml::parse($this->file['dirname'].'/'.$this->file['basename']);
        $groups = array_keys($configuration);

        foreach ($groups as $group) {
            foreach($configuration[$group] as $property => $string) {
                $constraints[$group][$property] = $this->parseString($string);
            }
        }

        $validationGroups = new ValidationGroups();

        foreach (array_keys($configuration) as $group) {
            $validationGroups->add($group, $this->parseConstraints($constraints[$group]));
        }

        return $validationGroups;
    }
}

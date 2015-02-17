<?php

namespace Melody\Validation\ValidationGroups\Parser;

use Melody\Validation\Exceptions\InvalidFileTypeException;
use Melody\Validation\ValidationGroups\AbstractValidationGroupsFileParser;
use Melody\Validation\ValidationGroups\ValidationGroups;

class YamlParser extends AbstractValidationGroupsFileParser
{
    /**
     * @param $file
     * @throws \Exception
     */
    public function __construct($file)
    {
        if (!class_exists('Symfony\Component\Yaml\Yaml')) {
            throw new \Exception("The Symfony Yaml component is required");
        }

        parent::__construct($file);
    }

    /**
     * @return ValidationGroups
     */
    public function parse()
    {
        if (strtolower($this->file['extension']) != 'yml') {
            throw new InvalidFileTypeException("Extension '{$this->file['extension']}' is not allowed");
        }

        $constraints = array();
        $configuration = \Symfony\Component\Yaml\Yaml::parse($this->file['dirname'].'/'.$this->file['basename']);
        $groups = array_keys($configuration);

        foreach ($groups as $group) {
            foreach ($configuration[$group] as $property => $string) {
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

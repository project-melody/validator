<?php
namespace Melody\Validation;

use Melody\Validation\Common\Collections\ConstraintsCollection;
use Symfony\Component\Yaml\Yaml;
use Melody\Validation\Validator;

class ValidationGroupsFactory
{

    private static $accepted_file_formats = array('php', 'yml');

    /**
     * @param array $configuration
     */
    public static function build(array $configuration)
    {
        return self::parseCofiguration($configuration);
    }

    /**
     * @param unknown_type $file
     * @throws \InvalidArgumentException
     */
    public static function buildFromFile($file)
    {
        if (!file_exists($file) || !is_readable($file)) {
            throw new \InvalidArgumentException("File $file not found or is not readable");
        }

        $fileinfo = pathinfo($file);

        if (!in_array($fileinfo['extension'], self::$accepted_file_formats)) {
            throw new \InvalidArgumentException("Extension '{$fileinfo['extension']}' is not allowed");
        }

        if ($fileinfo['extension'] == 'yml') {
            return self::parseYaml($file);
        } else {
            return self::parsePhp($file);
        }

    }

    /**
     * @param unknown_type $file
     * @return \Melody\Validation\ValidationGroups
     */
    public static function parsePhp($file)
    {
        $configuration = require $file;

        return self::parseCofiguration($configuration);
    }

    /**
     * @param unknown_type $file
     */
    public static function parseYaml($file)
    {
        $constraints = array();
        $configuration = Yaml::parse($file);
        $groups = array_keys($configuration);

        foreach ($groups as $group) {
            foreach($configuration[$group] as $property => $string) {
                $constraints[$group][$property] = self::parseString($string);
            }
        }

        $validationGroups = new ValidationGroups();

        foreach (array_keys($configuration) as $group) {
            $validationGroups->add($group, self::parseConstraints($constraints[$group]));
        }

        return $validationGroups;
    }

    protected static function parseString($string) {
        $validator = new Validator();

        $rules = explode("|", $string);
        foreach ($rules as $rule) {
            $parts = explode(":", $rule);
            $class = array_shift($parts);
            $options = $parts;

            $validator->set($class, $options);
        }

        return $validator;

    }

    /**
     * @param array $configuration
     */
    public static function parseCofiguration(array $configuration)
    {
        $validationGroups = new ValidationGroups();

        foreach (array_keys($configuration) as $group) {
            $validationGroups->add($group, self::parseConstraints($configuration[$group]));
        }

        return $validationGroups;
    }

    /**
     * @param array $constraints
     * @return \Melody\Validation\Common\Collections\ConstraintsCollection
     */
    public static function parseConstraints(array $constraints)
    {
        $constraintsCollection = new ConstraintsCollection();

        foreach ($constraints as $id => $constraint) {
            $constraintsCollection->set($id, $constraint);
        }

        return $constraintsCollection;
    }
}

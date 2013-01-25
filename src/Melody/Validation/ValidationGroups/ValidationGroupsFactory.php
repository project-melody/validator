<?php
namespace Melody\Validation\ValidationGroups;

use Melody\Validation\Common\Collections\ConstraintsCollection;
use Symfony\Component\Yaml\Yaml;
use Melody\Validation\Validator;

class ValidationGroupsFactory
{

    /**
     * @param \Melody\Validation\ValidationGroups\ValidationGroupsParserInterface $parser
     *
     * @return \Melody\Validation\ValidationGroups
     */
    public static function build(ValidationGroupsParserInterface $parser)
    {
        return $parser->parse();
    }

}

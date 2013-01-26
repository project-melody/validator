<?php
namespace Melody\Validation\ValidationGroups;

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

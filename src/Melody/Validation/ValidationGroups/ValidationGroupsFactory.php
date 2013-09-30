<?php
namespace Melody\Validation\ValidationGroups;

class ValidationGroupsFactory
{
    /**
     * @param \Melody\Validation\ValidationGroups\AbstractValidationGroupsParser $parser
     *
     * @return \Melody\Validation\ValidationGroups
     */
    public static function build(AbstractValidationGroupsParser $parser)
    {
        return $parser->parse();
    }
}

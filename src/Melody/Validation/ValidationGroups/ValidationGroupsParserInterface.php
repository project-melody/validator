<?php

namespace Melody\Validation\ValidationGroups;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
interface ValidationGroupsParserInterface
{
    function parse();
    function parseConstraints(array $constraints);
    function parseString($string);
}

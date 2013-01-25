<?php

namespace Melody\Validation\ValidationGroups;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
interface ValidationGroupsFileParserInterface extends ValidationGroupsParserInterface
{
    function __construct($file);
    function checkFile($file);
}

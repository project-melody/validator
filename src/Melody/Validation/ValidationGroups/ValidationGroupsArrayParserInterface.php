<?php

namespace Melody\Validation\ValidationGroups;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
interface ValidationGroupsArrayParserInterface extends ValidationGroupsParserInterface
{
    function __construct(array $configuration);
}

<?php

/*
 * This file is distributed under BSD licence.
 */

namespace Melody\Validation\Constraints;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
class EmailConstraint extends BaseConstraint
{
    public function __construct()
    {
        $this->errorMessageTemplate = "{{name}} must be a valid email";
    }

    public function validate($input)
    {
        return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }

}

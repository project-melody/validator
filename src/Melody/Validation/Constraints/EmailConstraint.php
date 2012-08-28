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
    public function __construct($messageTemplate = null)
    {
        if (!is_null($messageTemplate)) {
            $this->errorMessageTemplate = $messageTemplate;
        } else {
            $this->errorMessageTemplate = "{{name}} must be a valid email";
        }
    }

    public function validate($input)
    {
        return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }

}

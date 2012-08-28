<?php

/*
 * This file is distributed under BSD licence.
 */

namespace Melody\Validation\Constraints;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
class NotBlankConstraint extends BaseConstraint
{
    public function __construct($messageTemplate = null)
    {
        if (!is_null($messageTemplate)) {
            $this->errorMessageTemplate = $messageTemplate;
        } else {
            $this->errorMessageTemplate = "{{input}} must not be empty";
        }
    }

    public function validate($input)
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return !empty($input);
    }

}

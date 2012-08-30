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
    public function __construct($validationGroup = self::DEFAULT_GROUP, $messageTemplate = null)
    {
    	parent::__construct();

        if (!is_null($messageTemplate)) {
            $this->setErrorMessageTemplate($messageTemplate);
        } else {
            $this->setErrorMessageTemplate("{{input}} is not a valid email");
        }

		$this->setValidationGroup($validationGroup);
    }

    public function validate($input)
    {
        return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }

}

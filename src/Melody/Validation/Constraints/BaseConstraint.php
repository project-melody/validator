<?php

/*
 * This file is distributed under BSD licence.
 */

namespace Melody\Validation\Constraints;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
class BaseConstraint implements ConstraintsInterface
{
    public function __construct()
    {
        $this->errorMessageTemplate = "{{name}} is invalid";
    }

    public function setErrorMessageTemplate($template)
    {
        $this->errorMessageTemplate = $template;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}

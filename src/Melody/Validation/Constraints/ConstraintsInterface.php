<?php

/*
 * This file is distributed under BSD licence.
 */

namespace Melody\Validation\Constraints;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
interface ConstraintsInterface
{
    public function validate($input);
    public function setErrorMessageTemplate($template);
    public function getErrorMessageTemplate();
}

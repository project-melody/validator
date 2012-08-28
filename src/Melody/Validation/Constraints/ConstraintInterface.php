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
    public function validate();
    public function setErrorMessageTemplate();
    public function getErrorMessage();
}

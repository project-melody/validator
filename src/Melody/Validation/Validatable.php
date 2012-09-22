<?php

namespace Melody\Validation;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
interface Validatable
{
    public function validate($input);

    public function setErrorMessageTemplate($template);

    public function getErrorMessageTemplate();
}

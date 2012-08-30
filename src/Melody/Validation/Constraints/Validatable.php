<?php

namespace Melody\Validation\Constraints;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
interface Validatable
{
    public function validate($input);
    public function setErrorMessageTemplate($template);
    public function getErrorMessageTemplate();
    public function getValidationGroup();
    public function setValidationGroup();
}

<?php

namespace Melody\Validation;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
interface Validatable
{
    /**
     * Validates the input with the specified criteria
     * @param  $input
     * @return boolean
     */
    public function validate($input);

    /**
     * Sets a new message template
     *
     * @param string $template
     */
    public function setErrorMessageTemplate($template);

    /**
     * Returns the default error message template
     *
     * @return string
     */
    public function getErrorMessageTemplate();
}

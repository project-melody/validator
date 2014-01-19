<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
abstract class Constraint implements Validatable
{
    protected $errorMessageTemplate;

    public function __construct()
    {
        $this->setErrorMessageTemplate("The input is invalid");
    }

    /**
     * Sets a new message template
     *
     * @param string $template
     */
    public function setErrorMessageTemplate($template)
    {
        $this->errorMessageTemplate = $template;
    }

    /**
     * Returns the constraint id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

}


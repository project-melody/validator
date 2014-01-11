<?php

namespace Melody\Validation\Constraints;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
abstract class Constraint
{
    protected $errorMessageTemplate;

    public function __construct()
    {
        $this->setErrorMessageTemplate("{{input}} is invalid");
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


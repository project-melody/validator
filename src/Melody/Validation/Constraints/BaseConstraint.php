<?php

namespace Melody\Validation\Constraints;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
abstract class BaseConstraint implements Validatable
{
    protected $errorMessageTemplate;
    protected $validationGroup;
    const DEFAULT_GROUP = "main";

    public function __construct()
    {
        $this->setErrorMessageTemplate("{{name}} is invalid");
    }

    public function setErrorMessageTemplate($template)
    {
        $this->errorMessageTemplate = $template;
    }

    public function getErrorMessageTemplate()
    {
        return $this->errorMessageTemplate;
    }

    public function getValidationGroup()
    {
        return $this->validationGroup;
    }

    public function setValidationGroup($validationGroup = self::DEFAULT_GROUP)
    {
        $this->validationGroup = $validationGroup;
    }
}

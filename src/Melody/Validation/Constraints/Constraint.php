<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validatable;

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

    public function setErrorMessageTemplate($template)
    {
        $this->errorMessageTemplate = $template;
    }

    public function getId()
    {
        return $this->id;
    }

}

<?php

/*
 * This file is distributed under BSD licence.
 */

namespace Melody\Validation\Constraints;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
class CustomConstraint extends BaseConstraint
{
    private $callback;

    public function __construct($callback, $validationGroup = self::DEFAULT_GROUP, $messageTemplate = null)
    {
        parent::__construct();
        $this->callback = $callback;

        if (!is_null($messageTemplate)) {
            $this->setErrorMessageTemplate($messageTemplate);
        } else {
            $this->setErrorMessageTemplate("{{input}} is not a valid");
        }

        $this->setValidationGroup($validationGroup);
    }

    public function validate($args)
    {
        if (is_callable($this->callback)) {
            return call_user_func_array($this->callback, $args);
        } else {
            throw new \Exception("Invalid callback");
        }
    }

}

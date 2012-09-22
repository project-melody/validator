<?php
namespace Melody\Validation;

use Melody\Validation\ConstraintsBuilder;

class Validator
{

    /**
     * Violations list
     * @var Array
     */
    protected $violations = array();

    public function validate($input, $constraints)
    {
        if ($constraints instanceof ConstraintsBuilder) {
            foreach ($constraints->getConstraints() as $constraint) {
                if (!$constraint->validate($input)) {
                    $this->reportError($input, $constraint->getErrorMessageTemplate());
                }
            }
        }

        return $this->isValid();
    }

    /**
     * @return multitype:
     */
    public function getViolations()
    {
        return $this->violations;
    }

    public function reportError($input, $template)
    {
        $this->violations[] = $this->format($template, array('input' => $input));
    }

    /**
     * @return Bool
     */
    public function isValid()
    {
        return is_array($this->violations) && count($this->violations) == 0;
    }

    /**
     * @param String $template
     * @param array $vars
     * @return mixed|unknown
     */
    public function format($template, array $vars=array())
    {
        return preg_replace_callback(
                '/{{(\w+)}}/',
                function($match) use($vars) {
                    return isset($vars[$match[1]]) ? $vars[$match[1]] : $match[0];
                }, $template
        );
    }
}

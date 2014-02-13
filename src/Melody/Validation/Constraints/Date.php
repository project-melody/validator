<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;
use DateTime;

class Date extends Constraint
{
    protected $id = 'date';
    private $format;

    public function __construct($format = null)
    {
        $this->format = $format;
    }

    public function validate($input)
    {
        if ($input instanceof DateTime) {
            return true;
        }

        if (!is_string($input)) {
            return false;
        }

        if ($this->validateDateFromFormat($input)) {
            return true;
        }

        return false !== strtotime($input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be a valid date";
    }

    private function validateDateFromFormat($input)
    {
        $date = DateTime::createFromFormat($this->format, $input);

        if (!$date) {
            return false;
        }

        return $input === date($this->format, $date->getTimestamp());
    }

}

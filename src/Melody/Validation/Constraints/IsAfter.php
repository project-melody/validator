<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;
use Melody\Validation\Validator as v;

class IsAfter extends Constraint
{
    protected $id = 'isAfter';
    private $format;
    private $date;

    public function __construct($date, $format = null)
    {
        if (!v::date($this->format)->validate($date)) {
            throw new InvalidParameterException("The parameter must be a valid date");
        }

        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }

        $this->format = $format;
        $this->date = $date;
    }

    public function validate($input)
    {
        if (!v::date($this->format)->validate($input)) {
            throw new InvalidInputException("The input must be a valid date");
        }

        if (!$input instanceof \DateTime) {
            $input = new \DateTime($input);
        }

        return ($this->date < $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be after the given date";
    }
}

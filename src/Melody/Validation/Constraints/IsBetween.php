<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;
use Melody\Validation\Validator as v;

class IsBetween extends Constraint
{
    protected $id = 'isBetween';
    private $format;
    private $firstDate;
    private $secondDate;

    public function __construct($firstDate, $secondDate, $format = null)
    {
        if (!v::date($format)->validate($firstDate)) {
            throw new InvalidParameterException("The first date parameter must be a valid date");
        }

        if (!v::date($format)->validate($secondDate)) {
            throw new InvalidParameterException("The second date parameter must be a valid date");
        }

        $this->firstDate = $this->createDate($firstDate, $format);
        $this->secondDate = $this->createDate($secondDate, $format);
        $this->format = $format;
    }

    public function validate($input)
    {
        if (!v::date($this->format)->validate($input)) {
            throw new InvalidInputException("The input must be a valid date");
        }

        $input = $this->createDate($input, $this->format);

        if ($input < $this->firstDate) {
            return ($input < $this->firstDate && $input > $this->secondDate);
        }

        return ($input > $this->firstDate && $input < $this->secondDate);
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be between the given dates";
    }

    protected function createDate($date, $format = null)
    {
        if (!$date instanceof \DateTime && !is_null($format)) {
            $date = \DateTime::createFromFormat($format, $date);
        }

        if (!$date instanceof \DateTime && is_null($format)) {
            $date = new \DateTime($date);
        }

        return $date;
    }
}

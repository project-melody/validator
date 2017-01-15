<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;
use Melody\Validation\Validator as v;

class IsAfter extends Constraint
{
    use DateCreatorTrait;

    protected $id = 'isAfter';
    private $format;
    private $date;

    public function __construct($date, $format = null)
    {
        if (!v::date($format)->validate($date)) {
            throw new InvalidParameterException("The parameter must be a valid date");
        }

        $this->date = $this->createDate($date, $format);
        $this->format = $format;
    }

    public function validate($input)
    {
        if (!v::date($this->format)->validate($input)) {
            throw new InvalidInputException("The parameter must be a valid date");
        }

        $input = $this->createDate($input, $this->format);

        return ($this->date < $input);
    }

    public function getErrorMessageTemplate()
    {
        return "The input must be after the given date";
    }
}

<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Exceptions\InvalidParameterException;
use Melody\Validation\Exceptions\InvalidInputException;
use Melody\Validation\Validator as v;

class IsBetween extends Constraint
{
    use DateCreatorTrait;

    protected $id = 'isBetween';
    private $format;
    private $firstDate;
    private $secondDate;

    /**
     * @param $firstDate
     * @param $secondDate
     * @param null $format
     */
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

    /**
     * @param $input
     * @return bool
     */
    public function validate($input)
    {
        if (!v::date($this->format)->validate($input)) {
            throw new InvalidInputException("The input must be a valid date");
        }

        $input = $this->createDate($input, $this->format);

        return (
            (v::isAfter($this->firstDate)->validate($input) && v::isBefore($this->secondDate)->validate($input))
            || (v::isAfter($this->secondDate)->validate($input) && v::isBefore($this->firstDate)->validate($input))
        );
    }

    /**
     * @return string
     */
    public function getErrorMessageTemplate()
    {
        return "The input must be between the given dates";
    }
}

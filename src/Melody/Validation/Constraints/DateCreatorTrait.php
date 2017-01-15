<?php

namespace Melody\Validation\Constraints;

trait DateCreatorTrait
{
    /**
     * @param $date
     * @param null $format
     * @return bool|\DateTime
     */
    protected function createDate($date, $format = null)
    {
        if ($date instanceof \DateTime) {
            return $date;
        }

        if (is_null($format)) {
            return new \DateTime($date);
        }

        return \DateTime::createFromFormat($format, $date);
    }
}

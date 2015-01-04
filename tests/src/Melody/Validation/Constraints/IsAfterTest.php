<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;
use DateTime;

class IsAfterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testAnInvalidDateParameterShouldThrowAnException()
    {
        v::isAfter("invalid date");
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testAnInvalidDateInputShouldThrowAnException()
    {
        v::isAfter("now")->validate("invalid date");
    }

    /**
     * @dataProvider validComparisonDateProvider
     * @param $after
     * @param $before
     */
    public function testAValidDateAfterTheGivenDateStringShouldBeValidated(
        $after,
        $before
    ) {
        $this->assertTrue(v::isAfter($before)->validate($after));
    }

    /**
     * @dataProvider validComparisonDateProvider
     * @param $before
     * @param $after
     */
    public function testADateBeforeTheGivenDateStringShouldNotBeValidated(
        $before,
        $after
    ) {
        $this->assertFalse(v::isAfter($before)->validate($after));
    }

    /**
     * @dataProvider validComparisonDateProvider
     * @param $after
     * @param $before
     */
    public function testADateAfterTheGivenDateObjectShouldBeValidated(
        $after,
        $before
    ) {
        $this->assertTrue(v::isAfter(new DateTime($before))->validate(new DateTime($after)));
    }

    /**
     * @dataProvider validComparisonDateProvider
     * @param $before
     * @param $after
     */
    public function testADateBeforeTheGivenDateObjectShouldNotBeValidated(
        $before,
        $after
    ) {
        $this->assertFalse(v::isAfter(new DateTime($before))->validate(new DateTime($after)));
    }

    public function validComparisonDateProvider()
    {
        return array(
            array("tomorrow", "today"),
            array("today", "yesterday"),
            array("February", "January"),
            array("January 2014", "December 2013"),
            array("January", "January 2000"),
            array("2014-12-12 00:00:01", "2014-12-12 00:00:00"),
            array("December 30th", "January 1st"),
            array("10 seconds ago", "10 days ago")
        );
    }

    /**
     * @dataProvider validComparisonDatesWithFormatProvider
     * @param $format
     * @param $after
     * @param $before
     */
    public function testAValidDateAfterTheGivenDateStringWithFormatShouldBeValidated(
        $format,
        $after,
        $before
    ) {
        $this->assertTrue(v::isAfter($before, $format)->validate($after));
    }

    /**
     * @dataProvider validComparisonDatesWithFormatProvider
     * @param $format
     * @param $after
     * @param $before
     */
    public function testAnInvalidDateAfterTheGivenDateStringWithFormatShouldNotBeValidated(
        $format,
        $before,
        $after
    ) {
        $this->assertFalse(v::isAfter($before, $format)->validate($after));
    }

    public function validComparisonDatesWithFormatProvider()
    {
        return array(
            array(
                \DateTime::ATOM,
                "2013-12-15T15:52:01+00:00",
                "2012-12-15T15:52:01+00:00"
            ),
            array(
                \DateTime::COOKIE,
                "Sunday, 15-Dec-13 15:52:01 UTC",
                "Sunday, 15-Dec-12 15:52:01 UTC"
            ),
            array(
                \DateTime::ISO8601,
                "2013-12-15T15:52:01+0000",
                "2012-12-15T15:52:01+0000"
            ),
            array(
                \DateTime::RFC822,
                "Sun, 15 Dec 13 15:52:01 +0000",
                "Sun, 15 Dec 12 15:52:01 +0000"
            ),
            array(
                \DateTime::RFC850,
                "Sunday, 15-Dec-13 15:52:01 UTC",
                "Sunday, 15-Dec-12 15:52:01 UTC"
            ),
            array(
                \DateTime::RFC1036,
                "Sun, 15 Dec 13 15:52:01 +0000",
                "Sun, 15 Dec 12 15:52:01 +0000"
            ),
            array(
                \DateTime::RFC1123,
                "Sun, 15 Dec 2013 15:52:01 +0000",
                "Sun, 15 Dec 2012 15:52:01 +0000"
            ),
            array(
                \DateTime::RFC2822,
                "Sun, 15 Dec 2013 15:52:01 +0000",
                "Sun, 15 Dec 2012 15:52:01 +0000"
            ),
            array(
                \DateTime::RFC3339,
                "2013-12-15T15:52:01+00:00",
                "2012-12-15T15:52:01+00:00"
            ),
            array(
                \DateTime::RSS,
                "Sun, 15 Dec 2013 15:52:01 +0000",
                "Sun, 15 Dec 2012 15:52:01 +0000"
            ),
            array(
                \DateTime::W3C,
                "2013-12-15T15:52:01+00:00",
                "2012-12-15T15:52:01+00:00"
            )
        );
    }
}

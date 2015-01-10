<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;
use DateTime;

class IsBeforeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Melody\Validation\Exceptions\InvalidParameterException
     */
    public function testAnInvalidDateParameterShouldThrowAnException()
    {
        v::isBefore("invalid date");
    }

    /**
     * @expectedException Melody\Validation\Exceptions\InvalidInputException
     */
    public function testAnInvalidDateInputShouldThrowAnException()
    {
        v::isBefore("now")->validate("invalid date");
    }

    /**
     * @dataProvider validComparisonDateProvider
     * @param $after
     * @param $before
     */
    public function testAValidDateBeforeTheGivenDateStringShouldBeValidated(
        $before,
        $after
    ) {
        $this->assertTrue(v::isBefore($before)->validate($after));
    }

    /**
     * @dataProvider validComparisonDateProvider
     * @param $before
     * @param $after
     */
    public function testADateAfterTheGivenDateStringShouldNotBeValidated(
        $after,
        $before
    ) {
        $this->assertFalse(v::isBefore($before)->validate($after));
    }

    /**
     * @dataProvider validComparisonDateProvider
     * @param $after
     * @param $before
     */
    public function testADateBeforeTheGivenDateObjectShouldBeValidated(
        $before,
        $after
    ) {
        $this->assertTrue(v::isBefore(new DateTime($before))->validate(new DateTime($after)));
    }

    /**
     * @dataProvider validComparisonDateProvider
     * @param $before
     * @param $after
     */
    public function testADateAfterTheGivenDateObjectShouldNotBeValidated(
        $after,
        $before
    ) {
        $this->assertFalse(v::isBefore(new DateTime($before))->validate(new DateTime($after)));
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
    public function testAValidDateBeforeTheGivenDateStringWithFormatShouldBeValidated(
        $format,
        $before,
        $after
    ) {
        $this->assertTrue(v::isBefore($before, $format)->validate($after));
    }

    /**
     * @dataProvider validComparisonDatesWithFormatProvider
     * @param $format
     * @param $after
     * @param $before
     */
    public function testAnInvalidDateBeforeTheGivenDateStringWithFormatShouldNotBeValidated(
        $format,
        $after,
        $before
    ) {
        $this->assertFalse(v::isBefore($before, $format)->validate($after));
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
            ),
            array("Ymd", "20141010", "20131010"),
            array("Y-m-d", "2014-10-10", "2013-10-10"),
            array("Y/m/d", "2014/10/10", "2013/10/10"),
            array("Y m d", "2014 10 10", "2013 10 10"),
            array("d", "10", "05"),
            array("D", "Mon", "Sun"),
            array("D y", "Mon 12", "Mon 10"),
            array("j", "7", "4"),
            array("l", "Monday", "Sunday"),
            array("y", "12", "11"),
            array("Y", "2012", "2011"),
            array("m", "12", "11"),
            array("M", "Dec", "Nov")
        );
    }
}

<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;
use DateTime;

class IsBetweenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validDateBetweenRangeProvider
     */
    public function testTheMethodIsBetweenShouldReturnTrueWhenADateObjectIsBetweenTwoOthers($before, $actual, $after)
    {
        $this->assertTrue(v::isBetween(new DateTime($before), new DateTime($after))->validate(new DateTime($actual)));
    }

    public function validDateBetweenRangeProvider()
    {
        return [
            ["yesterday", "today", "tomorrow"],
            ["-10 seconds", "now", "+10 seconds"],
            ["October", "November", "December"],
            ["today", "tomorrow", "+2 days"],
            ["2014-12-12", "2014-12-13", "2014-12-14"],
            ["2014-12-12 00:00:01", "2014-12-13 00:00:02", "2014-12-14 00:00:02"],
            ["tomorrow", "today", "yesterday"],
            ["tomorrow", "today", "yesterday"]
        ];
    }

    /**
     * @dataProvider validDateWithFormatBetweenRangeProvider
     */
    public function testTheMethodIsBetweenShouldReturnTrueWhenADateObjectCreatedFromFormatIsBetweenTwoOthers(
        $format,
        $before,
        $actual,
        $after
    ) {
        $this->assertTrue(
            v::isBetween(
                \DateTime::createFromFormat($format, $before),
                \DateTime::createFromFormat($format, $after)
            )->validate(
                \DateTime::createFromFormat($format, $actual)
            )
        );
    }

    /**
     * @dataProvider validDateWithFormatBetweenRangeProvider
     */
    public function testTheMethodIsBetweenShouldReturnTrueWhenADateStringCreatedFromFormatIsBetweenTwoOthers(
        $format,
        $before,
        $actual,
        $after
    ) {
        $this->assertTrue(
            v::isBetween($before, $after, $format)->validate($actual)
        );
    }

    public function validDateWithFormatBetweenRangeProvider()
    {
        return array(
            array(
                \DateTime::ATOM,
                "2011-12-15T15:52:01+00:00",
                "2012-12-15T15:52:01+00:00",
                "2013-12-15T15:52:01+00:00",
            ),
            array(
                \DateTime::COOKIE,
                "Sunday, 15-Dec-11 15:52:01 UTC",
                "Sunday, 15-Dec-12 15:52:01 UTC",
                "Sunday, 15-Dec-13 15:52:01 UTC"
            ),
            array(
                \DateTime::ISO8601,
                "2011-12-15T15:52:01+0000",
                "2012-12-15T15:52:01+0000",
                "2013-12-15T15:52:01+0000"
            ),
            array(
                \DateTime::RFC822,
                "Sun, 15 Dec 11 15:52:01 +0000",
                "Sun, 15 Dec 12 15:52:01 +0000",
                "Sun, 15 Dec 13 15:52:01 +0000"
            ),
            array(
                \DateTime::RFC850,
                "Sunday, 15-Dec-11 15:52:01 UTC",
                "Sunday, 15-Dec-12 15:52:01 UTC",
                "Sunday, 15-Dec-13 15:52:01 UTC"
            ),
            array(
                \DateTime::RFC1036,
                "Sun, 15 Dec 11 15:52:01 +0000",
                "Sun, 15 Dec 12 15:52:01 +0000",
                "Sun, 15 Dec 13 15:52:01 +0000"
            ),
            array(
                \DateTime::RFC1123,
                "Sun, 15 Dec 2011 15:52:01 +0000",
                "Sun, 15 Dec 2012 15:52:01 +0000",
                "Sun, 15 Dec 2013 15:52:01 +0000"
            ),
            array(
                \DateTime::RFC2822,
                "Sun, 15 Dec 2011 15:52:01 +0000",
                "Sun, 15 Dec 2012 15:52:01 +0000",
                "Sun, 15 Dec 2013 15:52:01 +0000"
            ),
            array(
                \DateTime::RFC3339,
                "2011-12-15T15:52:01+00:00",
                "2012-12-15T15:52:01+00:00",
                "2013-12-15T15:52:01+00:00"
            ),
            array(
                \DateTime::RSS,
                "Sun, 15 Dec 2011 15:52:01 +0000",
                "Sun, 15 Dec 2012 15:52:01 +0000",
                "Sun, 15 Dec 2013 15:52:01 +0000"
            ),
            array(
                \DateTime::W3C,
                "2011-12-15T15:52:01+00:00",
                "2012-12-15T15:52:01+00:00",
                "2013-12-15T15:52:01+00:00"
            ),
            array("Ymd", "20111010", "20121010", "20131010"),
            array("Y-m-d", "2011-10-10", "2012-10-10", "2013-10-10"),
            array("Y/m/d", "2011/10/10", "2012/10/10", "2013/10/10"),
            array("Y m d", "2011 10 10", "2012 10 10", "2013 10 10"),
            array("d", "05", "08", "10"),
            array("D", "Mon", "Tue", "Wed"),
            array("D y", "Mon 11", "Mon 12", "Mon 13"),
            array("j", "1", "2", "3"),
            array("l", "Monday", "Tuesday", "Wednesday"),
            array("y", "11", "12", "13"),
            array("Y", "2011", "2012", "2013"),
            array("m", "10", "11", "12"),
            array("M", "Jan", "Feb", "Mar")
        );
    }

    /**
     * @dataProvider invalidDateBetweenRangeProvider
     */
    public function testTheMethodIsBetweenShouldReturnFalseWhenADateStringIsNotBetweenTwoOthers(
        $before,
        $actual,
        $after
    ) {
        $this->assertFalse(v::isBetween($before, $after)->validate(new DateTime($actual)));
    }

    /**
     * @dataProvider invalidDateBetweenRangeProvider
     */
    public function testTheMethodIsBetweenShouldReturnFalseWhenADateObjectIsNotBetweenTwoOthers(
        $before,
        $actual,
        $after
    ) {
        $this->assertFalse(v::isBetween(new DateTime($before), new DateTime($after))->validate(new DateTime($actual)));
    }

    public function invalidDateBetweenRangeProvider()
    {
        return [
            ["today", "yesterday", "tomorrow"],
            ["October", "January", "December"],
            ["now", "tomorrow", "yesterday"],
            ["2014-12-12", "2014-12-14", "2014-12-13"],
            ["2014-12-13 00:00:01", "2014-12-12 00:00:02", "2014-12-14 00:00:03"],
        ];
    }
}

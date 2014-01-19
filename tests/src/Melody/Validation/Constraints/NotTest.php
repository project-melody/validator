<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;

class NotTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForEmpty
     */
    public function test_negative_should_pass($input)
    {
        $this->assertTrue(v::not(v::notEmpty())->validate($input));
    }

    public function providerForNotEmpty()
    {
        return array(
            array(new \stdClass),
            array(array(666)),
            array(array(0)),
            array(' name'),
            array(1)
        );
    }

    public function providerForEmpty()
    {
        return array(
            array(''),
            array('    '),
            array("\n"),
            array(false),
            array(null)
        );
    }
}

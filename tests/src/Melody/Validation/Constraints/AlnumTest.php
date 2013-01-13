<?php

namespace Melody\Validation\Constraints;

use Melody\Validation\Validator as v;
use Melody\Validation\Exceptions\AlnumException;

class AlnumTest extends \PHPUnit_Framework_TestCase
{

    public function test_valid_string_should_pass()
    {
        $this->assertTrue(v::alnum()->validate('abcdef0123'));
    }

    public function test_invalid_string_should_fail_validation()
    {
        $this->assertFalse(v::alnum()->validate(' abcdef0123'));
    }

    public function test_invalid_string_exception_messages()
    {
        try {
            $this->assertFalse(v::alnum()->validate(' abcdef0123'));
        } catch (AlnumException $e) {

        }
    }
}

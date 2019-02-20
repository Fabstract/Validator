<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\NonNullValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\NonNullValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\NonNullValidation::isValid()
 * @see \Fabstract\Component\Validator\Validation\NonNullValidation::isValidated()
 */
class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testStdClassEqualsTrue()
    {
        $arguments = [new \stdClass()];

        $return = $this->call(NonNullValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testZeroEqualsTrue()
    {
        $arguments = [0];

        $return = $this->call(NonNullValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testEmptyStringEqualsTrue()
    {
        $arguments = [''];

        $return = $this->call(NonNullValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testEmptyArrayEqualsTrue()
    {
        $arguments = [[]];

        $return = $this->call(NonNullValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testStringNullEqualsTrue()
    {
        $arguments = ['null'];

        $return = $this->call(NonNullValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalse()
    {
        $arguments = [null];

        $return = $this->call(NonNullValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\BooleanValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\BooleanValidation;

class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(BooleanValidation::create()->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testTrueEqualsTrue()
    {
        $arguments = [true];

        $return = $this->call(BooleanValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testFalseEqualsTrue()
    {
        $arguments = [false];

        $return = $this->call(BooleanValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(BooleanValidation::create()->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testStringTrueEqualsFalse()
    {
        $arguments = ['true'];

        $return = $this->call(BooleanValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testIntegerOneEqualsFalse()
    {
        $arguments = [1];

        $return = $this->call(BooleanValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testIntegerZeroEqualsFalse()
    {
        $arguments = [0];

        $return = $this->call(BooleanValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

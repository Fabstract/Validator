<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\IntegerValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\IntegerValidation;

class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(IntegerValidation::create()->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testIntegerOneEqualsTrue()
    {
        $arguments = [1];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testIntegerZeroEqualsTrue()
    {
        $arguments = [0];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testNegativeOneEqualsTrue()
    {
        $arguments = [-1];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValueLessThanMaxValueEqualsTrue()
    {
        $arguments = [5];

        $return = $this->call(IntegerValidation::create()->setMaxValue(6), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValueEqualToMaxValueEqualsTrue()
    {
        $arguments = [5];

        $return = $this->call(IntegerValidation::create()->setMaxValue(5), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValueMoreThanMinValueEqualsTrue()
    {
        $arguments = [5];

        $return = $this->call(IntegerValidation::create()->setMinValue(4), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValueEqualToMinValueEqualsTrue()
    {
        $arguments = [5];

        $return = $this->call(IntegerValidation::create()->setMinValue(5), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(IntegerValidation::create()->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testStringOneEqualsFalse()
    {
        $arguments = ['1.0'];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testFloatOneEqualsFalse()
    {
        $arguments = [1.0];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testFloatZeroEqualsFalse()
    {
        $arguments = [0.0];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testTrueEqualsFalse()
    {
        $arguments = [true];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testArrayEqualsFalse()
    {
        $arguments = [[]];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testValueMoreThanMaxValueEqualsFalse()
    {
        $arguments = [6];

        $return = $this->call(IntegerValidation::create()->setMaxValue(5), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testValueLessThanMinValueEqualsFalse()
    {
        $arguments = [5];

        $return = $this->call(IntegerValidation::create()->setMinValue(6), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testInfinityEqualsFalse()
    {
        $arguments = [INF];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testNegativeInfinityEqualsFalse()
    {
        $arguments = [-INF];

        $return = $this->call(IntegerValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\NumberValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\NumberValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\NumberValidation::isValid()
 * @see \Fabstract\Component\Validator\Validation\NumberValidation::isValidated()
 */
class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(NumberValidation::create()->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testFloatOneEqualsTrue()
    {
        $arguments = [1.0];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testFloatZeroEqualsTrue()
    {
        $arguments = [0.0];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testNegativeOneEqualsTrue()
    {
        $arguments = [-1.0];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testInfinityEqualsTrue()
    {
        $arguments = [INF];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testNegativeInfinityEqualsTrue()
    {
        $arguments = [-INF];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValueLessThanMaxValueEqualsTrue()
    {
        $arguments = [5.0];

        $return = $this->call(NumberValidation::create()->setMaxValue(5.1), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValueEqualToMaxValueEqualsTrue()
    {
        $arguments = [5.0];

        $return = $this->call(NumberValidation::create()->setMaxValue(5.0), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValueMoreThanMinValueEqualsTrue()
    {
        $arguments = [5.0];

        $return = $this->call(NumberValidation::create()->setMinValue(4.9), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValueEqualToMinValueEqualsTrue()
    {
        $arguments = [5.0];

        $return = $this->call(NumberValidation::create()->setMinValue(5.0), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testIntegerZeroEqualsTrue()
    {
        $arguments = [0];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testIntegerOneEqualsTrue()
    {
        $arguments = [1];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(NumberValidation::create()->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testStringOneEqualsFalse()
    {
        $arguments = ['1.0'];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testTrueEqualsFalse()
    {
        $arguments = [true];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testArrayEqualsFalse()
    {
        $arguments = [[]];

        $return = $this->call(NumberValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testValueMoreThanMaxValueEqualsFalse()
    {
        $arguments = [5.1];

        $return = $this->call(NumberValidation::create()->setMaxValue(5.0), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testValueLessThanMinValueEqualsFalse()
    {
        $arguments = [5.0];

        $return = $this->call(NumberValidation::create()->setMinValue(5.1), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

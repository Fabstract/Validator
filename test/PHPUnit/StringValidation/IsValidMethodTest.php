<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\StringValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\StringValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\StringValidation::isValid()
 * @see \Fabstract\Component\Validator\Validation\StringValidation::isValidated()
 */
class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(StringValidation::create()->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testEmptyStringEqualsTrue()
    {
        $arguments = [''];

        $return = $this->call(StringValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testBlankStringEqualsTrue()
    {
        $arguments = [' '];

        $return = $this->call(StringValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testNormalStringEqualsTrue()
    {
        $arguments = ['string'];

        $return = $this->call(StringValidation::create(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLengthLessThanMaxLengthEqualsTrue()
    {
        $arguments = ['string'];

        $return = $this->call(StringValidation::create()->setMaxLength(7), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLengthEqualToMaxLengthEqualsTrue()
    {
        $arguments = ['string'];

        $return = $this->call(StringValidation::create()->setMaxLength(6), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLengthMoreThanMinLengthEqualsTrue()
    {
        $arguments = ['string'];

        $return = $this->call(StringValidation::create()->setMinLength(5), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testLengthEqualToMinLengthEqualsTrue()
    {
        $arguments = ['string'];

        $return = $this->call(StringValidation::create()->setMinLength(6), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(StringValidation::create()->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testIntEqualsFalse()
    {
        $arguments = [1];

        $return = $this->call(StringValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testArrayEqualsFalse()
    {
        $arguments = [[]];

        $return = $this->call(StringValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testZeroEqualsFalse()
    {
        $arguments = [0];

        $return = $this->call(StringValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testTrueEqualsFalse()
    {
        $arguments = [true];

        $return = $this->call(StringValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLengthMoreThanMaxLengthEqualsFalse()
    {
        $arguments = ['string'];

        $return = $this->call(StringValidation::create()->setMaxLength(5), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testLengthLessThanMinLengthEqualsFalse()
    {
        $arguments = ['string'];

        $return = $this->call(StringValidation::create()->setMinLength(7), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

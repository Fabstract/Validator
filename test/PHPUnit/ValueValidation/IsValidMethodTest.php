<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ValueValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\ValueValidation;

class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(ValueValidation::create()->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidStringEqualsTrue()
    {
        $arguments = ['string'];

        $return = $this->call(ValueValidation::create()->setValues(['string']), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidIntegerEqualsTrue()
    {
        $arguments = [1];

        $return = $this->call(ValueValidation::create()->setValues(['string', 1]), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidIntArrayEqualsTrue()
    {
        $arguments = [[1, 2]];

        $return = $this->call(ValueValidation::create()->setValues(['string', [1, 2]]), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testIntegerOneEqualsTrueWhenStringOneIsAllowedAndTypeStrictIsFalse()
    {
        $arguments = [1];

        $return = $this->call(ValueValidation::create()->setValues(['1'])->setTypeStrict(false), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(ValueValidation::create()->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testNullEqualsFalseWhenNullIsIncludedInValues()
    {
        $arguments = [null];

        $return = $this->call(ValueValidation::create()->setValues([null]), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testInvalidIntArrayEqualsFalse()
    {
        $arguments = [[1, 3]];

        $return = $this->call(ValueValidation::create()->setValues(['string', [1, 2]]), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testInvalidStringEqualsFalse()
    {
        $arguments = ['string'];

        $return = $this->call(ValueValidation::create()->setValues(['strin']), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testStringCaseSensitivity()
    {
        $arguments = ['string'];

        $return = $this->call(ValueValidation::create()->setValues(['String']), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testIntegerOneEqualsFalseWhenStringOneIsAllowedAndTypeStrictIsTrue()
    {
        $arguments = [1];

        $return = $this->call(ValueValidation::create()->setValues(['1'])->setTypeStrict(true), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

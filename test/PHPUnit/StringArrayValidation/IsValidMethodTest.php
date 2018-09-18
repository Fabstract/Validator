<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\StringArrayValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Constant\ArrayTypes;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\StringArrayValidation;

class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(StringArrayValidation::create()->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testArrayEqualsTrue()
    {
        $arguments = [[]];

        $return = $this->call(new StringArrayValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testCorrectMinLengthEqualsTrue()
    {
        $arguments = [['a', 'b']];

        $return = $this->call(StringArrayValidation::create()->setMinLength(2), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testCorrectMaxLengthEqualsTrue()
    {
        $arguments = [['a', 'b']];

        $return = $this->call(StringArrayValidation::create()->setMaxLength(2), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidSetTypeArray()
    {
        $arguments = [['a', 'b', 'c']];

        $return = $this->call(StringArrayValidation::create()->setType(ArrayTypes::SET), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidSequentialTypeArray()
    {
        $arguments = [['a', 'b', 'c']];

        $return = $this->call(StringArrayValidation::create()->setType(ArrayTypes::SEQUENTIAL), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidVectorTypeArray()
    {
        $arguments = [['a', 'b', 'c']];

        $return = $this->call(StringArrayValidation::create()->setType(ArrayTypes::VECTOR), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testElementsThatMatchPatternEqualsTrue()
    {
        $arguments = [['abcd xyz abcd', 'string xyz string']];

        $return = $this->call(StringArrayValidation::create()->setPattern('/xyz/'), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(StringArrayValidation::create()->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testArrayOfArrayEqualsFalse()
    {
        $arguments = [[[]]];

        $return = $this->call(StringArrayValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testArrayOfIntegerEqualsFalse()
    {
        $arguments = [[1, 2]];

        $return = $this->call(StringArrayValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testArrayOfIntegerAndStringEqualsFalse()
    {
        $arguments = [['1', 2]];

        $return = $this->call(StringArrayValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testArrayOfNullEqualsFalse()
    {
        $arguments = [[null]];

        $return = $this->call(StringArrayValidation::create(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testElementsThatDoNotMatchPatternEqualsFalse()
    {
        $arguments = [['abcd xyz abcd', 'string xyz string', 'string xy string']];

        $return = $this->call(StringArrayValidation::create()->setPattern('/xyz/'), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

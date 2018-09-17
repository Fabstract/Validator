<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Constant\ArrayTypes;
use Fabstract\Component\Validator\Validation\ArrayValidation;

class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(ArrayValidation::create()->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testArrayEqualsTrue()
    {
        $arguments = [[]];

        $return = $this->call(new ArrayValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testArrayOfArrayEqualsTrue()
    {
        $arguments = [[[]]];

        $return = $this->call(new ArrayValidation(), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testCorrectMinLengthEqualsTrue()
    {
        $arguments = [['a', 'b']];

        $return = $this->call(ArrayValidation::create()->setMinLength(2), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testCorrectMaxLengthEqualsTrue()
    {
        $arguments = [['a', 'b']];

        $return = $this->call(ArrayValidation::create()->setMaxLength(2), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidSetTypeArray()
    {
        $arguments = [['a', 'b', 'c']];

        $return = $this->call(ArrayValidation::create()->setType(ArrayTypes::SET), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidSequentialTypeArray()
    {
        $arguments = [['a', 'b', 'c']];

        $return = $this->call(ArrayValidation::create()->setType(ArrayTypes::SEQUENTIAL), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidVectorTypeArray()
    {
        $arguments = [['a', 'b', 'c']];

        $return = $this->call(ArrayValidation::create()->setType(ArrayTypes::VECTOR), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(ArrayValidation::create()->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testNullEqualsFalse()
    {
        $arguments = [null];

        $return = $this->call(new ArrayValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testIntegerEqualsFalse()
    {
        $arguments = [1];

        $return = $this->call(new ArrayValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testStringEqualsFalse()
    {
        $arguments = ['string'];

        $return = $this->call(new ArrayValidation(), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testIncorrectMinLengthEqualsFalse()
    {
        $arguments = [['a', 'b']];

        $return = $this->call(ArrayValidation::create()->setMinLength(3), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testIncorrectMaxLengthEqualsFalse()
    {
        $arguments = [['a', 'b']];

        $return = $this->call(ArrayValidation::create()->setMaxLength(1), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testInvalidSetTypeArray()
    {
        $arguments = [['a', 'b', 'c', 'a']];

        $return = $this->call(ArrayValidation::create()->setType(ArrayTypes::SET), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testInvalidSequentialTypeArray()
    {
        $arguments = [['key' => 'value']];

        $return = $this->call(ArrayValidation::create()->setType(ArrayTypes::SEQUENTIAL), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testInvalidVectorTypeArray()
    {
        $arguments = [['a', 1]];

        $return = $this->call(ArrayValidation::create()->setType(ArrayTypes::VECTOR), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

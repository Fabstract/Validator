<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\StringValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\StringValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\StringValidation::setMinLength()
 */
class SetMinLengthMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testZeroDoesNotThrow()
    {
        $arguments = [0];

        $this->call(StringValidation::create(), $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testOneDoesNotThrow()
    {
        $arguments = [1];

        $this->call(StringValidation::create(), $arguments);
    }

    #endregion

    #region incorrect arguments

    public function testNegativeOneThrowsTypeConflictException()
    {
        $arguments = [-1];

        $this->expectException(TypeConflictException::class);

        $this->call(StringValidation::create(), $arguments);
    }

    public function testStringOneThrowsTypeConflictException()
    {
        $arguments = ['1'];

        $this->expectException(TypeConflictException::class);

        $this->call(StringValidation::create(), $arguments);
    }

    public function testFloatOneThrowsTypeConflictException()
    {
        $arguments = [1.0];

        $this->expectException(TypeConflictException::class);

        $this->call(StringValidation::create(), $arguments);
    }

    public function testInfinityThrowsTypeConflictException()
    {
        $arguments = [INF];

        $this->expectException(TypeConflictException::class);

        $this->call(StringValidation::create(), $arguments);
    }

    #endregion
}

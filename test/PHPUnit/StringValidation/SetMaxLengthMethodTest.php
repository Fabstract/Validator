<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\StringValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\StringValidation;

class SetMaxLengthMethodTest extends MethodTestBase
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

    /**
     * @doesNotPerformAssertions
     */
    public function testInfinityDoesNotThrow()
    {
        $arguments = [INF];

        $this->call(StringValidation::create(), $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFloatOneDoesNotThrow()
    {
        $arguments = [1.0];

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

    #endregion
}

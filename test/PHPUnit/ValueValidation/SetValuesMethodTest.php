<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ValueValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\ValueValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\ValueValidation::setValues()
 */
class SetValuesMethodTest extends MethodTestBase
{
    public function testNonArrayThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        /** @noinspection PhpParamsInspection */
        $this->call(ValueValidation::create()->setValues(1), [1]);
    }
}

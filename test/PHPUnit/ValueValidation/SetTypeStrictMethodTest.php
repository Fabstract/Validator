<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ValueValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\ValueValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\ValueValidation::setTypeStrict()
 */
class SetTypeStrictMethodTest extends MethodTestBase
{
    public function testNonBooleanThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $this->call(ValueValidation::create()->setTypeStrict('true'), [1]);
    }
}

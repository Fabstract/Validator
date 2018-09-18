<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ValidationMetadata;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\StringValidation;
use Fabstract\Component\Validator\ValidationMetadata;
use Fabstract\Component\Validator\Validator;

class SetValidationListMethodTest extends MethodTestBase
{
    public function testEmptyPropertyNameThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $arguments = ['', [StringValidation::class]];

        $this->call(new ValidationMetadata(), $arguments);
    }

    public function testNonStringPropertyNameThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $arguments = [null, StringValidation::class];

        $this->call(new ValidationMetadata(), $arguments);
    }

    public function testInvalidValidationThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $arguments = ['property', [new Validator()]];

        $this->call(new ValidationMetadata(), $arguments);
    }

    public function testInvalidValidationThrowsTypeConflictException2()
    {
        $this->expectException(TypeConflictException::class);

        $arguments = ['property', [Validator::class]];

        $this->call(new ValidationMetadata(), $arguments);
    }
}

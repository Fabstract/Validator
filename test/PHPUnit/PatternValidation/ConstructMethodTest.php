<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\PatternValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\PatternValidation;

class ConstructMethodTest extends MethodTestBase
{
    public function testEmptyConstructorThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        PatternValidation::create();
    }

    public function testNullParamThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        PatternValidation::create(null);
    }

    public function testInvalidRegexPatternParamThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        PatternValidation::create('string');
    }
}

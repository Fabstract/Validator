<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\StringArrayValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\StringArrayValidation;

class SetPatternMethodTest extends MethodTestBase
{
    public function testInvalidPatternThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $this->call(StringArrayValidation::create()->setPattern('1'), [['abc']]);
    }

}

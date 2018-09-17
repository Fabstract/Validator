<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Constant\ArrayTypes;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\ArrayValidation;

class SetTypeMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testGetEqualsSet()
    {
        $this->assertEquals(ArrayTypes::SET, ArrayValidation::create()->setType(ArrayTypes::SET)->getType());
    }

    #endregion

    #region incorrect arguments

    public function testIncorrectTypeThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $arguments = ['incorrect value'];

        $this->call(ArrayValidation::create(), $arguments);
    }

    #endregion
}

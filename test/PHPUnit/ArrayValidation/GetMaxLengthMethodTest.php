<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\Validator;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\ArrayValidation;

class GetMaxLengthMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10, $this->call(ArrayValidation::create()->setMaxLength(10)));
    }
}

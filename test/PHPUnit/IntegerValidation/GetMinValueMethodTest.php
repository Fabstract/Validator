<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\IntegerValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\IntegerValidation;

class GetMinValueMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10, $this->call(IntegerValidation::create()->setMinValue(10)));
    }
}

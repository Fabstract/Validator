<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ValueValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\ValueValidation;

class GetValuesMethodTest extends MethodTestBase
{
    public function testGetEqualsTest()
    {
        $this->assertEquals([1, 'abc'], $this->call(ValueValidation::create()->setValues([1, 'abc'])));
    }
}

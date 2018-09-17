<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\StringValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\StringValidation;

class GetMaxLengthMethodTest extends MethodTestBase
{
    public function testGetSetEquals()
    {
        $this->assertEquals(10, $this->call(StringValidation::create()->setMaxLength(10)));
    }
}

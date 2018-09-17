<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ FloatValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\FloatValidation;

class GetMaxValueMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10.0, $this->call(FloatValidation::create()->setMaxValue(10.0)));
    }
}

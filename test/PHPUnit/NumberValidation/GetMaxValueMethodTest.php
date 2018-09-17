<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\NumberValidation;

use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;
use Fabstract\Component\Validator\Validation\NumberValidation;

class GetMaxValueMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10, $this->call(NumberValidation::create()->setMaxValue(10)));
    }
}


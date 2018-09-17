<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\NumericValidation;

use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;
use Fabstract\Component\Validator\Validation\NumericValidation;

class GetMaxValueMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10, $this->call(NumericValidation::create()->setMaxValue(10)));
    }
}


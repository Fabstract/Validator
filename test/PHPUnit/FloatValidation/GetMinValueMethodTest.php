<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\FloatValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\FloatValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\FloatValidation::getMinValue()
 */
class GetMinValueMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10.0, $this->call(FloatValidation::create()->setMinValue(10.0)));
    }
}

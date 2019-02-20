<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\NumberValidation;

use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;
use Fabstract\Component\Validator\Validation\NumberValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\NumberValidation::getMinValue()
 */
class GetMinValueMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10, $this->call(NumberValidation::create()->setMinValue(10)));
    }
}

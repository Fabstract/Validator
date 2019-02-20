<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\NumericValidation;

use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;
use Fabstract\Component\Validator\Validation\NumericValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\NumericValidation::getMaxValue()
 */
class GetMaxValueMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10, $this->call(NumericValidation::create()->setMaxValue(10)));
    }
}


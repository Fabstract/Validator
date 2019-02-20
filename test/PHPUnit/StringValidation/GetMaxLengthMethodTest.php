<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\StringValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\StringValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\StringValidation::getMaxLength()
 */
class GetMaxLengthMethodTest extends MethodTestBase
{
    public function testGetSetEquals()
    {
        $this->assertEquals(10, $this->call(StringValidation::create()->setMaxLength(10)));
    }
}

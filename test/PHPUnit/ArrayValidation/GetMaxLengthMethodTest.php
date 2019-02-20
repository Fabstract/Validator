<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\ArrayValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\ArrayValidation::getMaxLength()
 */
class GetMaxLengthMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(10, $this->call(ArrayValidation::create()->setMaxLength(10)));
    }
}

<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\ArrayValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\ArrayValidation::getMinLength()
 */
class GetMinLengthMethodTest extends MethodTestBase
{

    public function testGetEqualsSet()
    {
        $this->assertEquals(5, $this->call(ArrayValidation::create()->setMinLength(5)));
    }
}

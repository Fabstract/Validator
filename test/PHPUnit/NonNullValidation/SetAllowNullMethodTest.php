<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\NonNullValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\NonNullValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\NonNullValidation::setAllowNull()
 */
class SetAllowNullMethodTest extends MethodTestBase
{
    public function testException()
    {
        $this->expectException(\Exception::class);

        $this->call(NonNullValidation::create(), [true]);
    }
}

<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ValueValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\ValueValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\ValueValidation::isTypeStrict()
 */
class IsTypeStrictMethodTest extends MethodTestBase
{
    public function testGetEqualsSet()
    {
        $this->assertEquals(false, $this->call(ValueValidation::create()->setTypeStrict(false)));
    }
}

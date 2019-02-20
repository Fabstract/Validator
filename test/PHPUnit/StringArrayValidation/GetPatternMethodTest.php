<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\StringArrayValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\StringArrayValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\StringArrayValidation::getPattern()
 */
class GetPatternMethodTest extends MethodTestBase
{
    public function testGetEqualsSet()
    {
        $this->assertEquals('/abc/', $this->call(StringArrayValidation::create()->setPattern('/abc/')));
    }
}

<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\PatternValidation;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validation\PatternValidation;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\Validation\PatternValidation::isValid()
 * @see \Fabstract\Component\Validator\Validation\PatternValidation::isValidated()
 */
class IsValidMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testNullEqualsTrueWhenAllowNullIsTrue()
    {
        $arguments = [null];

        $return = $this->call(PatternValidation::create('//')->setAllowNull(true), $arguments);

        $this->assertEquals(true, $return);
    }

    public function testValidStringThatMatchesPatternEqualsTrue()
    {
        $arguments = ['I match the regex'];

        $return = $this->call(PatternValidation::create('/[\s\w]+/'), $arguments);

        $this->assertEquals(true, $return);
    }

    #endregion

    #region incorrect arguments

    public function testNullEqualsFalseWhenAllowNullIsFalse()
    {
        $arguments = [null];

        $return = $this->call(PatternValidation::create('//')->setAllowNull(false), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testValidStringThatDoesNotMatchPatternEqualsFalse()
    {
        $arguments = ['I do not match the regex because I include a dot.'];

        $return = $this->call(PatternValidation::create('/^[\s\w]+$/'), $arguments);

        $this->assertEquals(false, $return);
    }

    public function testInvalidArgumentEqualsFalse()
    {
        $arguments = [[]];

        $return = $this->call(PatternValidation::create('/^[\s\w]+$/'), $arguments);

        $this->assertEquals(false, $return);
    }

    #endregion
}

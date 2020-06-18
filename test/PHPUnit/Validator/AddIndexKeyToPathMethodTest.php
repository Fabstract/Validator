<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\Validator;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Validator;

/**
 * Class AddIndexKeyToPathMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\Validator
 *
 * @see \Fabstract\Component\Validator\Validator::addIndexKeyToPath()
 */
class AddIndexKeyToPathMethodTest extends MethodTestBase
{
    #region correct arguments

    public function testStringIndexKey()
    {
        $arguments = [[], 'property'];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(['property'], $return);
    }

    public function testIntIndexKey()
    {
        $arguments = [[], 1];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(['[1]'], $return);
    }

    #endregion

    #region incorrect arguments

    #endregion
}

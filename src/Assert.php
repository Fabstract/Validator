<?php

namespace Fabstract\Component\Validator;

use Fabstract\Component\Validator\Exception\TypeConflictException;

class Assert extends \Fabstract\Component\Assert\Assert
{
    /**
     * @param string $name
     * @param string $expected
     * @param string $given
     * @return TypeConflictException
     */
    protected static function generateException($name, $expected, $given)
    {
        $exception = parent::generateException($name, $expected, $given);
        return new TypeConflictException(
            $exception->getMessage(),
            $exception->getCode(),
            $exception
        );
    }
}

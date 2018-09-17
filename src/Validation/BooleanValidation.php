<?php

namespace Fabstract\Component\Validator\Validation;

/**
 * Class BooleanValidation
 * @package Fabstract\Component\Validator\Validation
 *
 * @see \Fabstract\Component\Validator\Test\PHPUnit\BooleanValidation\IsValidMethodTest
 */
class BooleanValidation extends ValidationBase
{
    /**
     * @param string $non_null_value
     * @return bool
     */
    protected function isValidated($non_null_value)
    {
        if (is_bool($non_null_value) === true) {
            return true;
        }

        $this->setErrorMessage("Value must be boolean");
        return false;
    }
}

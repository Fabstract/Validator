<?php

namespace Fabstract\Component\Validator\Validation;

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
        return false;
    }
}

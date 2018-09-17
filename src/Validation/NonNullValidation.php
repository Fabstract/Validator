<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Exception\Exception;

class NonNullValidation extends ValidationBase
{
    /**
     * @param string $non_null_value
     * @return bool
     */
    function isValidated($non_null_value)
    {
        // For now parameter non_null_value is guaranteed to be non-null
        // but this may change in the future, so check if value is not null
        // just to be safe.
        return $non_null_value !== null;
    }

    /**
     * @param bool $allow_null
     * @return ValidationBase|void
     * @throws Exception
     */
    public final function setAllowNull($allow_null)
    {
        $class_name = NonNullValidation::class;
        throw new Exception("cannot call setAllowNull on ${class_name}");
    }

    /**
     * @return bool
     */
    public function getAllowNull()
    {
        return false;
    }
}

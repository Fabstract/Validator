<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Assert;

/**
 * Class ValueValidation
 * @package Fabstract\Component\Validator\Validation
 *
 * @see \Fabstract\Component\Validator\Test\PHPUnit\ValueValidation\IsValidMethodTest
 */
class ValueValidation extends ValidationBase
{
    /** @var mixed[] */
    private $valid_values = [];
    /** @var bool */
    private $type_strict = true;

    /**
     * Including null in valid_values will NOT work.
     * @see \Fabstract\Component\Validator\Validation\ValidationBase::isValid() for why null won't work.
     *
     * @param mixed[] $valid_values
     * @return ValueValidation
     * @see \Fabstract\Component\Validator\Test\PHPUnit\ValueValidation\SetValuesMethodTest
     */
    public function setValues($valid_values)
    {
        Assert::isArray($valid_values, 'valid_values');

        $this->valid_values = $valid_values;
        return $this;
    }

    /**
     * @return mixed[]
     * @see \Fabstract\Component\Validator\Test\PHPUnit\ValueValidation\GetValuesMethodTest
     */
    public function getValues()
    {
        return $this->valid_values;
    }

    /**
     * @return bool
     * @see \Fabstract\Component\Validator\Test\PHPUnit\ValueValidation\IsTypeStrictMethodTest
     */
    public function isTypeStrict()
    {
        return $this->type_strict;
    }

    /**
     * @param bool $type_strict
     * @return ValueValidation
     * @see \Fabstract\Component\Validator\Test\PHPUnit\ValueValidation\SetTypeStrictMethodTest
     */
    public function setTypeStrict($type_strict)
    {
        Assert::isBoolean($type_strict, 'type_strict');

        $this->type_strict = $type_strict;
        return $this;
    }

    /**
     * @param mixed $non_null_value
     * @return bool
     */
    protected function isValidated($non_null_value)
    {
        $is_valid = in_array($non_null_value, $this->valid_values, $this->isTypeStrict());
        if ($is_valid) {
            return true;
        }

        $values = $this->getValidValuesString();
        $given = $this->isConvertibleToString($non_null_value) ? strval($non_null_value) : gettype($non_null_value);
        $this->setErrorMessage("Value must be one of ${values} given ${given}");
        return false;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    private function isConvertibleToString($value)
    {
        if (is_string($value) || is_int($value) || is_float($value) || is_bool($value)) {
            return true;
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private function getValidValuesString()
    {
        $values_string = [];
        foreach ($this->valid_values as $valid_value) {
            if ($this->isConvertibleToString($valid_value)) {
                $values_string[] = strval($valid_value);
            } else {
                $values_string[] = gettype($valid_value);
            }
        }
        return implode('|', $values_string);
    }
}

<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Assert;

/**
 * Class IntegerValidation
 * @package Fabstract\Component\Validator\Validation
 *
 * @see \Fabstract\Component\Validator\Test\PHPUnit\IntegerValidation\IsValidMethodTest
 */
class IntegerValidation extends ValidationBase
{
    /** @var int|float */
    private $min_value = -INF;
    /** @var int|float */
    private $max_value = INF;

    /**
     * @param string $non_null_value
     * @return bool
     */
    function isValidated($non_null_value)
    {
        if (is_int($non_null_value) !== true) {
            $this->setErrorMessage('Value must be int');
            return false;
        }

        $min_value = $this->getMinValue();
        if ($non_null_value < $min_value) {
            $this->setErrorMessage("Integer must be at least {$min_value}");
            return false;
        }

        $max_value = $this->getMaxValue();
        if ($non_null_value > $max_value) {
            $this->setErrorMessage("Integer must be at most {$max_value}");
            return false;
        }

        return true;
    }

    /**
     * @return float|int
     * @see \Fabstract\Component\Validator\Test\PHPUnit\IntegerValidation\GetMinValueMethodTest
     */
    public function getMinValue()
    {
        return $this->min_value;
    }

    /**
     * @param float|int $min_value
     * @return IntegerValidation
     */
    public function setMinValue($min_value)
    {
        Assert::isIntOrFloat($min_value, 'min_value');
        $this->min_value = $min_value;
        return $this;
    }

    /**
     * @return float|int
     * @see \Fabstract\Component\Validator\Test\PHPUnit\IntegerValidation\GetMaxValueMethodTest
     */
    public function getMaxValue()
    {
        return $this->max_value;
    }

    /**
     * @param float|int $max_value
     * @return IntegerValidation
     */
    public function setMaxValue($max_value)
    {
        Assert::isIntOrFloat($max_value, 'max_value');
        $this->max_value = $max_value;
        return $this;
    }
}

<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Assert;

/**
 * Class StringValidation
 * @package Fabstract\Component\Validator\Validation
 *
 * @see \Fabstract\Component\Validator\Test\PHPUnit\StringValidation\IsValidMethodTest
 */
class StringValidation extends ValidationBase
{
    /** @var int */
    private $min_length = 0;
    /** @var int|float */
    private $max_length = INF;

    /**
     * @param $non_null_value
     * @return bool
     */
    function isValidated($non_null_value)
    {
        if (is_string($non_null_value) !== true) {
            $this->setErrorMessage('Value must be string');
            return false;
        }

        $str_length = mb_strlen($non_null_value);
        $min_length = $this->getMinLength();
        if ($str_length < $min_length) {
            $this->setErrorMessage("String must be at least {$min_length} character(s) long.");
            return false;
        }

        $max_length = $this->getMaxLength();
        if ($str_length > $max_length) {
            $this->setErrorMessage("String must be at most {$max_length} character(s) long.");
            return false;
        }

        return true;
    }

    /**
     * @return int
     * @see \Fabstract\Component\Validator\Test\PHPUnit\StringValidation\GetMinLengthMethodTest
     */
    public function getMinLength()
    {
        return $this->min_length;
    }

    /**
     * @param int $min_length
     * @return StringValidation
     * @see \Fabstract\Component\Validator\Test\PHPUnit\StringValidation\SetMinLengthMethodTest
     */
    public function setMinLength($min_length)
    {
        Assert::isNotNegativeInt($min_length, 'min_length');

        $this->min_length = $min_length;
        return $this;
    }

    /**
     * @return float|int
     * @see \Fabstract\Component\Validator\Test\PHPUnit\StringValidation\GetMaxLengthMethodTest
     */
    public function getMaxLength()
    {
        return $this->max_length;
    }

    /**
     * @param int|float $max_length
     * @return StringValidation
     * @see \Fabstract\Component\Validator\Test\PHPUnit\StringValidation\SetMaxLengthMethodTest
     */
    public function setMaxLength($max_length)
    {
        Assert::isNotNegativeNumber($max_length, false, 'max_length');

        $this->max_length = $max_length;
        return $this;
    }
}

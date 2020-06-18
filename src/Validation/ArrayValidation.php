<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Assert;
use Fabstract\Component\Validator\Constant\ArrayTypes;

/**
 * Class ArrayValidation
 * @package Fabstract\Component\Validator\Validation
 *
 * @see \Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation\IsValidMethodTest
 */
class ArrayValidation extends ValidationBase
{
    /** @var int|float */
    protected $min_length = 0;
    /** @var int|float */
    protected $max_length = INF;
    /** @var string */
    protected $type = ArrayTypes::ANY;

    /**
     * @param array $non_null_value
     * @return bool
     */
    protected function isValidated($non_null_value)
    {
        if (is_array($non_null_value) !== true) {
            $this->setErrorMessage('Value must be array');
            return false;
        }

        $min_length = $this->getMinLength();
        if (count($non_null_value) < $min_length) {
            $this->setErrorMessage("Array's length must be at least {$min_length}");
            return false;
        }

        $max_length = $this->getMaxLength();
        if (count($non_null_value) > $max_length) {
            $this->setErrorMessage("Array's length must be at most {$max_length}");
            return false;
        }

        switch ($this->type) {
            case ArrayTypes::SET:
                $type_is_validated = $this->isSet($non_null_value);
                break;
            case ArrayTypes::VECTOR:
                $type_is_validated = $this->isVector($non_null_value);
                break;
            case ArrayTypes::SEQUENTIAL:
                $type_is_validated = $this->isSequential($non_null_value);
                break;
            default:
                $type_is_validated = true;
                break;
        }

        if ($type_is_validated !== true) {
            return false;
        }

        return true;
    }

    /**
     * @return float|int
     * @see \Fabstract\Component\Validator\Test\PHPUnit\Validator\GetMinLengthMethodTest
     */
    public function getMinLength()
    {
        return $this->min_length;
    }

    /**
     * @param float|int $min_length
     * @return ArrayValidation
     */
    public function setMinLength($min_length)
    {
        Assert::isNotNegativeInt($min_length, 'min_length');

        $this->min_length = $min_length;
        return $this;
    }

    /**
     * @return float|int
     * @see \Fabstract\Component\Validator\Test\PHPUnit\Validator\GetMaxLengthMethodTest
     */
    public function getMaxLength()
    {
        return $this->max_length;
    }

    /**
     * @param float|int max_length
     * @return ArrayValidation
     */
    public function setMaxLength($max_length)
    {
        Assert::isNotNegativeInt($max_length, 'max_length');

        $this->max_length = $max_length;
        return $this;
    }

    /**
     * @param string $type
     * @return ArrayValidation
     * @see \Fabstract\Component\Validator\Test\PHPUnit\Validator\SetTypeMethodTest
     */
    public function setType($type)
    {
        Assert::isInArray($type,
            [
                ArrayTypes::ANY,
                ArrayTypes::SET,
                ArrayTypes::VECTOR,
                ArrayTypes::SEQUENTIAL
            ],
            true,
            'type'
        );

        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array $array
     * @return bool
     */
    private function isSet($array)
    {
        $is_unique = count($array) === count(array_unique($array));

        if ($is_unique) {
            return true;
        }

        $this->setErrorMessage('Set array values must be unique');
        return false;
    }

    /**
     * @param array $array
     * @return bool
     */
    private function isSequential($array)
    {
        $array_length = count($array);
        if ($array_length === 0){
            return true;
        }

        $is_sequential = array_keys($array) === range(0, $array_length - 1);
        if ($is_sequential) {
            return true;
        }

        $this->setErrorMessage('Sequential array keys must be sequential');
        return false;
    }

    /**
     * @param array $array
     * @return bool
     */
    private function isVector($array)
    {
        if ($this->isSequential($array) !== true) {
            return false;
        }

        $type = null;
        foreach ($array as $value) {
            $value_type = gettype($value);
            if ($type === null) {
                $type = $value_type;
                continue;
            }
            if ($type !== $value_type) {
                $this->setErrorMessage('Vector array values must be the same type');
                return false;
            }
        }

        return true;
    }
}

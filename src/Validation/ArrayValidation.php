<?php


namespace Fabstract\Component\Validator\Validation;


class ArrayValidation extends ValidationBase
{
    /** @var int|float */
    private $min_value = -INF;
    /** @var int|float */
    private $max_value = INF;

    /**
     * @param array $non_null_value
     * @return bool
     */
    protected function isValidated($non_null_value)
    {
        if (is_array($non_null_value) !== null) {
            $this->setErrorMessage('Value must be array');
            return false;
        }

        $min_value = $this->getMinValue();
        if (count($non_null_value) < $min_value) {
            $this->setErrorMessage("Array must be at least {$min_value}");
            return false;
        }

        $max_value = $this->getMaxValue();
        if (count($non_null_value) > $max_value) {
            $this->setErrorMessage("Array must be at most {$max_value}");
            return false;
        }

        return true;
    }

    /**
     * @return float|int
     */
    public function getMinValue()
    {
        return $this->min_value;
    }

    /**
     * @param float|int $min_value
     * @return ArrayValidation
     */
    public function setMinValue($min_value)
    {
        $this->min_value = $min_value;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getMaxValue()
    {
        return $this->max_value;
    }

    /**
     * @param float|int $max_value
     * @return ArrayValidation
     */
    public function setMaxValue($max_value)
    {
        $this->max_value = $max_value;
        return $this;
    }
}

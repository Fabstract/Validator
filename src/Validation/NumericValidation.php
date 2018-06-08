<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Assert\Assert;

class NumericValidation extends ValidationBase
{
    /** @var float */
    private $min_value = -INF;
    /** @var float */
    private $max_value = INF;

    /**
     * @param int|float $non_null_value
     * @return bool
     */
    protected function isValidated($non_null_value)
    {
        if (!is_numeric($non_null_value)) {
            $this->setErrorMessage('Value must be numeric');
            return false;
        }

        $min_value = $this->getMinValue();
        if ($non_null_value < $min_value) {
            $this->setErrorMessage("Numeric value must be at least {$min_value}");
            return false;
        }

        $max_value = $this->getMaxValue();
        if ($non_null_value > $max_value) {
            $this->setErrorMessage("Numeric value must be at most {$max_value}");
            return false;
        }

        return true;
    }

    /**
     * @return int|float
     */
    public function getMinValue()
    {
        return $this->min_value;
    }

    /**
     * @param int|float $min_value
     * @return NumericValidation
     */
    public function setMinValue($min_value)
    {
        Assert::isIntOrFloat($min_value);
        $this->min_value = $min_value;
        return $this;
    }

    /**
     * @return int|float
     */
    public function getMaxValue()
    {
        return $this->max_value;
    }

    /**
     * @param int|float $max_value
     * @return NumericValidation
     */
    public function setMaxValue($max_value)
    {
        Assert::isIntOrFloat($max_value);
        $this->max_value = $max_value;
        return $this;
    }
}

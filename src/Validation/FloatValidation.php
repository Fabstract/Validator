<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Assert;

class FloatValidation extends ValidationBase
{
    /** @var float */
    private $min_value = -INF;
    /** @var float */
    private $max_value = INF;

    /**
     * @param string $non_null_value
     * @return bool
     */
    protected function isValidated($non_null_value)
    {
        if (is_float($non_null_value) !== true) {
            $this->setErrorMessage('Value must be float');
            return false;
        }

        $min_value = $this->getMinValue();
        if ($non_null_value < $min_value) {
            $this->setErrorMessage("Float must be at least {$min_value}");
            return false;
        }

        $max_value = $this->getMaxValue();
        if ($non_null_value > $max_value) {
            $this->setErrorMessage("Float must be at most {$max_value}");
            return false;
        }

        return true;
    }

    /**
     * @return float
     */
    public function getMinValue()
    {
        return $this->min_value;
    }

    /**
     * @param float $min_value
     * @return FloatValidation
     */
    public function setMinValue($min_value)
    {
        Assert::isFloat($min_value);
        $this->min_value = $min_value;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxValue()
    {
        return $this->max_value;
    }

    /**
     * @param float $max_value
     * @return FloatValidation
     */
    public function setMaxValue($max_value)
    {
        Assert::isFloat($max_value);
        $this->max_value = $max_value;
        return $this;
    }
}

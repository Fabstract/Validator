<?php


namespace Fabstract\Component\Validator\Validation;


use ArrayTypes;

class ArrayValidation extends ValidationBase
{
    /** @var int|float */
    private $min_length = 0;
    /** @var int|float */
    private $max_length = INF;
    /** @var string */
    private $type = null;


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

        $type = $this->getType();
        if ($type !== null) {
            $default_value = ArrayTypes::MAP[$type];
            foreach ($non_null_value as $element) {
                if (gettype($element) !== gettype($default_value)) {
                    $this->setErrorMessage("Array type's not match the given type {$type}");
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @return float|int
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
        $this->min_length = $min_length;
        return $this;
    }

    /**
     * @return float|int
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
        $this->max_length = $max_length;
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
     * @param string $type
     * @return ArrayValidation
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}

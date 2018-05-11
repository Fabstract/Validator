<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Assert;

class StringArrayValidation extends ArrayValidation
{
    /** @var string */
    protected $pattern = null;

    public function isValidated($non_null_value)
    {
        $is_validated = parent::isValidated($non_null_value);

        if ($is_validated === false) {
            return false;
        }

        foreach ($non_null_value as $value) {
            if (is_string($value) === false) {
                $given = gettype($value);
                $this->setErrorMessage("Array's element type must be string, given " . $given);
                return false;
            }
        }

        if ($this->pattern !== null) {
            foreach ($non_null_value as $value) {
                if (preg_match($this->pattern, $value) !== 1) {
                    $this->setErrorMessage("Value must match pattern {$this->pattern}.");
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param string $pattern
     * @return StringArrayValidation
     */
    public function setPattern($pattern)
    {
        Assert::isRegexPattern($pattern, 'pattern');

        $this->pattern = $pattern;
        return $this;
    }
}

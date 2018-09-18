<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Assert;

class PatternValidation extends ValidationBase
{

    /** @var string */
    protected $pattern = null;

    /**
     * PatternValidation constructor.
     * @param string $pattern
     */
    function __construct($pattern)
    {
        Assert::isRegexPattern($pattern, 'pattern');

        $this->pattern = $pattern;
    }

    /**
     * @param string $pattern
     * @return PatternValidation
     */
    public static function create($pattern = null)
    {
        return new static($pattern);
    }

    /**
     * @param string $non_null_value
     * @return bool
     */
    function isValidated($non_null_value)
    {
        if (is_string($non_null_value) !== true) {
            $given = gettype($non_null_value);
            $this->setErrorMessage("Value must be string, given ${given}");
            return false;
        }

        if (preg_match($this->pattern, $non_null_value) !== 1) {
            $this->setErrorMessage("Value must match pattern {$this->pattern}.");
            return false;
        }

        return true;
    }
}

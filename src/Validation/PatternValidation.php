<?php


namespace Fabstract\Component\Validator\Validation;


use Fabstract\Component\Validator\Assert;

class PatternValidation extends ValidationBase
{

    /** @var string */
    private $pattern = null;

    /**
     * PatternValidation constructor.
     * @param string $pattern
     */
    function __construct($pattern)
    {
        Assert::isNotNull($pattern, 'pattern');
        Assert::isRegexPattern($pattern, 'pattern');

        $this->pattern = $pattern;
    }

    /**
     * @param string $non_null_value
     * @return bool
     */
    function isValidated($non_null_value)
    {
        if (preg_match($this->pattern, $non_null_value) !== 1) {
            $this->setErrorMessage("Value must match pattern {$this->pattern}.");
            return false;
        }

        return true;
    }
}

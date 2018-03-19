<?php


namespace Fabs\Component\Validator\Validation;


use Fabs\Component\Validator\Assert;
use Fabs\Component\Validator\ValidationInterface;

abstract class ValidationBase implements ValidationInterface
{
    /** @var string */
    private $error_message = null;
    /** @var bool */
    private $allow_null = false;

    /**
     * Does nothing more than creating a new instance. It is useful when using
     * fluent setters since it gets rid of extra parenthesis that comes with
     * constructor and new keyword.
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        if ($value === null && !$this->getAllowNull()) {
            $this->setErrorMessage('Value cannot be null');
            return false;
        }

        $is_validated = static::isValidated($value);
        if ($is_validated === false) {
            Assert::isNotNullOrWhiteSpace($this->getMessage(), 'error message');
        }

        return $is_validated;
    }

    /**
     * @param string $error_message
     */
    protected function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
    }

    /**
     * @param string $non_null_value
     * @return bool
     */
    abstract function isValidated($non_null_value);

    /**
     * @return bool
     */
    public function getAllowNull()
    {
        return $this->allow_null;
    }

    /**
     * @param bool $allow_null
     * @return ValidationBase
     */
    public function setAllowNull($allow_null)
    {
        $this->allow_null = $allow_null;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->error_message;
    }
}

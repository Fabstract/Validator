<?php

namespace Fabstract\Component\Validator\Validation;

use Fabstract\Component\Validator\Assert;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\ValidationInterface;

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
     * @throws TypeConflictException
     */
    public function isValid($value)
    {
        if ($value === null) {
            if ($this->getAllowNull() === true) {
                return true;
            }

            $this->setErrorMessage('Value cannot be null');
            return false;
        }

        $is_validated = static::isValidated($value);
        if ($is_validated === false) {
            try {
                Assert::isNotNullOrWhiteSpace($this->getMessage());
            } catch (TypeConflictException $exception) {
                $class_name = static::class;
                throw new TypeConflictException(
                    "Validation ${class_name} should set message to non-empty value before returning false",
                    0,
                    $exception
                );
            }
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
    abstract protected function isValidated($non_null_value);

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

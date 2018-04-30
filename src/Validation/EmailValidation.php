<?php

namespace Fabstract\Component\Validator\Validation;

class EmailValidation extends PatternValidation
{
    public final function __construct()
    {
        $pattern = '/^\w.+@\w+\.[a-zA-Z]{2,}$/';
        parent::__construct($pattern);
    }

    protected final function setErrorMessage($error_message)
    {
        $pattern = $this->pattern;
        $error_message = "Values must match email pattern (${pattern})";
        parent::setErrorMessage($error_message);
    }
}

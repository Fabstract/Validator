<?php

namespace Fabstract\Component\Validator\Validation;

/**
 * Class EmailValidation
 * @package Fabstract\Component\Validator\Validation
 * @see \Fabstract\Component\Validator\Test\PHPUnit\EmailValidation\IsValidMethodTest
 *
 * VALID VALUES
 * example@example.com
 * Example@example.com
 * 123example@example.com
 * ex123ample@example.com
 * e_xample@example.com
 * e-xample@example.com
 * exampl.e@example.com
 * exa.mple@example.com
 * exa'mple@example.com
 * e'xample@example.com
 * exa&mple@example.com
 * exa+mple@example.com
 * example@Example.com
 * example@EXAMPLE.com
 * example@exa-mple.com
 * example@example.com.uk
 * example@example.co
 *
 * INVALID VALUES
 * exa!mple@example.com
 * exa?mple@example.com
 * exa|mple@example.com
 * e..xample@example.com
 * example@_example.com
 * example@-example.com
 * example@example..com
 * e@xample@example.com
 * exa$mple@example.com
 */
class EmailValidation extends PatternValidation
{
    public final function __construct()
    {
        $pattern = '/^[^\W_]+[\.\-\\\'\+\&_]?[^\W_]+@[^\W_]+[\-\&\\\'_]?[^\W_]+\.[^\W_]{2,}(?:\.[^\W_]{2})?$/';
        parent::__construct($pattern);
    }

    protected final function setErrorMessage($error_message)
    {
        $pattern = $this->pattern;
        $error_message = "Values must match email pattern (${pattern})";
        parent::setErrorMessage($error_message);
    }
}

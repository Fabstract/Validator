<?php

namespace Fabstract\Component\Validator;

interface ValidatorInterface
{
    /**
     * @param ValidatableInterface $value
     * @return ValidationError[]
     */
    public function validate($value);
}

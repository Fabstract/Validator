<?php

namespace Fabs\Component\Validator;

interface ValidatorInterface
{
    /**
     * @param ValidatableInterface $value
     * @return ValidationError[]
     */
    public function validate($value);
}

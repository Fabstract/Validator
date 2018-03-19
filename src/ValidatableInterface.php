<?php

namespace Fabstract\Component\Validator;

interface ValidatableInterface
{
    /**
     * @param ValidationMetadata $validation_metadata
     * @return void
     */
    public function configureValidationMetadata($validation_metadata);
}

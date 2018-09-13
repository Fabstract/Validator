<?php

namespace Fabstract\Component\Validator\Test\PHPUnit;

use Fabstract\Component\Validator\ValidatableInterface;
use Fabstract\Component\Validator\Validation\StringValidation;
use Fabstract\Component\Validator\ValidationMetadata;

class ClassWithNonExistentPropertyValidation implements ValidatableInterface
{

    /**
     * @param ValidationMetadata $validation_metadata
     * @return void
     */
    public function configureValidationMetadata($validation_metadata)
    {
        $validation_metadata->addValidation('property', StringValidation::create());
    }
}

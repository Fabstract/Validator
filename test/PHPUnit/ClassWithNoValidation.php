<?php

namespace Fabstract\Component\Validator\Test\PHPUnit;

use Fabstract\Component\Validator\ValidatableInterface;
use Fabstract\Component\Validator\ValidationMetadata;

class ClassWithNoValidation implements ValidatableInterface
{
    public $property1 = null;
    public $property2 = null;

    /**
     * @param ValidationMetadata $validation_metadata
     * @return void
     */
    public function configureValidationMetadata($validation_metadata)
    {
    }
}

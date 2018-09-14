<?php

namespace Fabstract\Component\Validator\Test\PHPUnit;

use Fabstract\Component\Validator\ValidatableInterface;
use Fabstract\Component\Validator\Validation\StringValidation;
use Fabstract\Component\Validator\ValidationMetadata;

class ClassWithProtectedProperty implements ValidatableInterface
{
    protected $protected_property = null;
    protected $protected_validatable_property = null;

    /**
     * @param ValidationMetadata $validation_metadata
     * @return void
     */
    public function configureValidationMetadata($validation_metadata)
    {
        $validation_metadata
            ->addValidation('protected_property', StringValidation::create()->setMinLength(1));
    }

    public function setProperty($value)
    {
        $this->protected_property = $value;
    }

    public function setProtectedValidatableProperty($protected_validatable_property)
    {
        $this->protected_validatable_property = $protected_validatable_property;
    }
}

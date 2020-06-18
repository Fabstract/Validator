<?php

namespace Fabstract\Component\Validator;

/**
 * Class ValidationMetadata
 * @package Fabstract\Component\Validator
 */
class ValidationMetadata
{
    /** @var ValidationInterface[][] */
    private $validation_lookup = [];

    /**
     * @param string $property_name
     * @param string|ValidationInterface $validation
     * @return ValidationMetadata
     * @see \Fabstract\Component\Validator\Test\PHPUnit\ValidationMetadata\AddValidationMethodTest
     */
    public function addValidation($property_name, $validation)
    {
        Assert::isNotEmptyString($property_name, false, 'property_name');

        if (is_string($validation)) {
            Assert::isClassExists($validation, 'validation');
            $validation = new $validation;
        }

        Assert::isType($validation, ValidationInterface::class, 'validation');

        $this->validation_lookup[$property_name][] = $validation;
        return $this;
    }

    /**
     * @param string $property_name
     * @param ValidationInterface[] $validation_list
     * @return ValidationMetadata
     * @see \Fabstract\Component\Validator\Test\PHPUnit\ValidationMetadata\SetValidationListMethodTest
     */
    public function setValidationList($property_name, $validation_list)
    {
        Assert::isNotEmptyString($property_name, false, 'property_name');
        Assert::isArrayOfType($validation_list, ValidationInterface::class, 'validation_list');

        $this->validation_lookup[$property_name] = $validation_list;
        return $this;
    }

    /**
     * @return ValidationInterface[][]
     */
    public function getPropertyValidationLookup()
    {
        return $this->validation_lookup;
    }
}

<?php

namespace Fabstract\Component\Validator;

class ValidationMetadata implements \ArrayAccess
{
    /** @var ValidationInterface[][] */
    private $validation_lookup = [];

    /**
     * @param string $property_name
     * @param string|ValidationInterface $validation
     * @return ValidationMetadata
     */
    public function addValidation($property_name, $validation)
    {
        Assert::isString($property_name, 'property_name');

        if (is_string($validation)) {
            Assert::isClassExists($validation, 'validation');
            $validation = new $validation;
        }

        Assert::isType($validation, ValidationInterface::class, 'validation');

        $this->validation_lookup[$property_name][] = $validation;
        return $this;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param string $property_name <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($property_name)
    {
        Assert::isNotEmptyString($property_name, false, 'property_name');
        return array_key_exists($property_name, $this->validation_lookup);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param string $property_name <p>
     * The offset to retrieve.
     * </p>
     * @return ValidationInterface[] Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($property_name)
    {
        Assert::isNotEmptyString($property_name, false, 'property_name');
        return $this->validation_lookup[$property_name];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param string $property_name <p>
     * The offset to assign the value to.
     * </p>
     * @param ValidationInterface[] $type <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($property_name, $type)
    {
        Assert::isNotEmptyString($property_name, false, 'property_name');
        Assert::isArray($type, 'type');
        $this->validation_lookup[$property_name] = $type;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param string $property_name <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($property_name)
    {
        Assert::isNotEmptyString($property_name, false, 'property_name');
        unset($this->validation_lookup[$property_name]);
    }
}

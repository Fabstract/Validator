<?php

namespace Fabstract\Component\Validator;

class Validator implements ValidatorInterface
{
    /** @var ValidationMetadata[] */
    private $validation_metadata_lookup = [];

    /**
     * @param ValidatableInterface $value
     * @return ValidationError[]
     */
    public function validate($value)
    {
        if (is_array($value)) {
            Assert::isArrayOfType($value, ValidatableInterface::class, 'value');
        } else {
            Assert::isType($value, ValidatableInterface::class, 'value');
        }

        return $this->validateInternal($value);
    }

    /**
     * @param array $array
     * @param string[] $path
     * @return ValidationError[]
     */
    private function validateArray($array, $path = [])
    {
        Assert::isArray($array, 'array');

        /** @var ValidationError[] $validation_error_list */
        $validation_error_list = [];
        foreach ($array as $key => $element) {
            $validation_error_list =
                array_merge($validation_error_list, $this->validateInternal($element, $this->addIndexKeyToPath($path, $key)));
        }

        return $validation_error_list;
    }

    /**
     * @param string[] $path
     * @param string|int $index_key
     * @return string[]
     */
    private function addIndexKeyToPath($path, $index_key)
    {
        if (is_int($index_key)) {
            $index_key = sprintf('[%s]', strval($index_key));
        }
        return array_merge($path, [$index_key]);
    }

    /**
     * @param ValidatableInterface $value
     * @param string $class_name
     * @return ValidationMetadata
     */
    private function getValidationMetadata($value, $class_name)
    {
        if (array_key_exists($class_name, $this->validation_metadata_lookup) === false) {
            $validation_metadata = new ValidationMetadata();
            $value->configureValidationMetadata($validation_metadata);
            $this->validation_metadata_lookup[$class_name] = $validation_metadata;
        }

        return $this->validation_metadata_lookup[$class_name];
    }

    /**
     * @param mixed $property_value
     * @param ValidationInterface[] $validation_list
     * @return string[]
     */
    private function validateProperty($property_value, $validation_list)
    {
        /** @var string[] $validation_error_message_list */
        $validation_error_message_list = [];

        foreach ($validation_list as $validation) {
            if ($validation->isValid($property_value) !== true) {
                $validation_error_message_list[] = $validation->getMessage();
            }
        }

        return $validation_error_message_list;
    }

    /**
     * @noinspection PhpDocMissingThrowsInspection
     * @param mixed $value
     * @param string[] $path
     * @return ValidationError[]
     */
    private function validateInternal($value, $path = [])
    {
        if (is_array($value)) {
            return $this->validateArray($value, $path);
        }

        if (!$value instanceof ValidatableInterface) {
            return [];
        }

        /** @var ValidationError[] $validation_error_list */
        $validation_error_list = [];

        $class_name = get_class($value);

        $validation_metadata = $this->getValidationMetadata($value, $class_name);
        /** @noinspection PhpUnhandledExceptionInspection */
        $reflection_class = new \ReflectionClass($class_name);
        $properties = $reflection_class->getProperties();
        foreach ($properties as $property) {
            $property_value = $property->getValue($value);
            $property_name = $property->getName();

            /** @var ValidationError[] $property_validation_error_list */
            $property_validation_error_list = [];

            if ($validation_metadata->offsetExists($property_name) === true) {
                $validation_list = $validation_metadata[$property_name];
                $validation_error_message_list = $this->validateProperty($property_value, $validation_list);

                foreach ($validation_error_message_list as $validation_error_message) {
                    $property_validation_error_list[] = new ValidationError(
                        $class_name,
                        $property_name,
                        $property_value,
                        $validation_error_message,
                        $this->addIndexKeyToPath($path, $property_name)
                    );
                }
            }

            if (count($property_validation_error_list) === 0) {
                $property_validation_error_list =
                    $this->validateInternal($property_value, $this->addIndexKeyToPath($path, $property_name));
            }

            $validation_error_list = array_merge($validation_error_list, $property_validation_error_list);
        }

        return $validation_error_list;
    }
}

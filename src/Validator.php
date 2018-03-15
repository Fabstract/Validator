<?php

namespace Fabs\Component\Validator;

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
        Assert::isType($value, ValidatableInterface::class, 'value');
        return $this->validateInternal($value);
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
     * @param string $property_name
     * @param mixed $property_value
     * @param ValidationMetadata $validation_metadata
     * @param string[] $path
     * @return array
     */
    private function validateProperty($property_name, $property_value, $validation_metadata, $path)
    {
        if ($validation_metadata->offsetExists($property_name) === false) {
            return [];
        }

        $validation_errors = [];

        /** @var ValidationInterface $validation */
        foreach ($validation_metadata[$property_name] as $validation) {
            if ($validation->isValid($property_value) === false) {
                $property_path = $path;
                $property_path[] = $property_name;

                $validation_errors[] = new ValidationError(
                    $property_name,
                    $property_value,
                    $validation->getMessage(),
                    $property_path
                );
            }
        }

        return $validation_errors;
    }

    /**
     * @param mixed $value
     * @param string[] $path
     * @return ValidationError[]
     */
    private function validateInternal($value, $path = [])
    {
        $validation_error_list = [];

        $class_name = get_class($value);

        $validation_metadata = $this->getValidationMetadata($value, $class_name);
        $reflection_class = new \ReflectionClass($class_name);
        $properties = $reflection_class->getProperties();
        foreach ($properties as $property) {
            $property_value = $property->getValue($value);
            $property_name = $property->getName();
            $property_validation_error_list = $this->validateProperty(
                $property_name,
                $property_value,
                $validation_metadata,
                $path
            );

            if (count($property_validation_error_list) === 0) {
                if ($property_value instanceof ValidatableInterface) {
                    $property_path = $path;
                    $property_path [] = $property_name;
                    $property_validation_error_list = $this->validateInternal($property_value, $property_path);
                } elseif (is_array($property_value) === true) {
                    $property_validation_error_list = [];
                    foreach ($property_value as $key => $property_value_item) {
                        if ($property_value_item instanceof ValidatableInterface) {
                            $property_value_item_path = $path;
                            $property_value_item_path[] = $property_name;
                            $property_value_item_path[] = sprintf('[%s]', strval($key));
                            $property_value_item_validation_error_list = $this->validateInternal($property_value_item, $property_value_item_path);

                            $property_validation_error_list = array_merge($property_value_item_validation_error_list, $property_validation_error_list);
                        }
                    }
                }
            }
            $validation_error_list = array_merge($property_validation_error_list, $validation_error_list);
        }

        return $validation_error_list;
    }
}

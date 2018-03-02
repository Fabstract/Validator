<?php

namespace Fabs\Component\Validator;

class ValidationError
{
    /**
     * @var string
     */
    private $property_name = null;
    /**
     * @var mixed
     */
    private $property_value = null;
    /**
     * @var string
     */
    private $message = null;
    /**
     * @var string[]
     */
    private $property_path;

    /**
     * ValidationError constructor.
     * @param string $property_name
     * @param mixed $property_value
     * @param string $message
     * @param string[] $property_path
     */
    public function __construct($property_name, $property_value, $message, $property_path)
    {

        $this->property_name = $property_name;
        $this->property_value = $property_value;
        $this->message = $message;
        $this->property_path = $property_path;
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->property_name;
    }

    /**
     * @return mixed
     */
    public function getPropertyValue()
    {
        return $this->property_value;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string[]
     */
    public function getPropertyPath()
    {
        return $this->property_path;
    }

    /**
     * @return string[]
     */
    public function getPropertyPathAsString()
    {
        return implode('.', $this->property_path);
    }

    public function __toString()
    {
        return sprintf(
            'Validation failed at "%s". Message is "%s".',
            $this->getPropertyPathAsString(),
            $this->getMessage()
        );
    }
}

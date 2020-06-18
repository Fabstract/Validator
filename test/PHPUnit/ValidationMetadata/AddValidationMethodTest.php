<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ValidationMetadata;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\StringValidation;
use Fabstract\Component\Validator\ValidationMetadata;
use stdClass;

/**
 * Class GetMaxLengthMethodTest
 * @package Fabstract\Component\Validator\Test\PHPUnit\ArrayValidation
 *
 * @see \Fabstract\Component\Validator\ValidationMetadata::addValidation()
 */
class AddValidationMethodTest extends MethodTestBase
{
    public function testAddEqualsGet()
    {
        $property_name = 'property';
        $string_validation = StringValidation::create();
        $arguments = [$property_name, $string_validation];

        /** @var ValidationMetadata $validation_metadata */
        $validation_metadata = $this->call(new ValidationMetadata(), $arguments);

        $return = $validation_metadata->getPropertyValidationLookup()[$property_name];

        $this->assertCount(1, $return);
        $this->assertEquals($string_validation, $return[0]);
    }

    public function testAddEqualsGetForString()
    {
        $property_name = 'property';
        $arguments = [$property_name, StringValidation::class];

        /** @var ValidationMetadata $validation_metadata */
        $validation_metadata = $this->call(new ValidationMetadata(), $arguments);

        $return = $validation_metadata->getPropertyValidationLookup()[$property_name];

        $this->assertCount(1, $return);
        $this->assertInstanceOf(StringValidation::class, $return[0]);
    }

    public function testEmptyPropertyNameThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $arguments = ['', StringValidation::class];

        $this->call(new ValidationMetadata(), $arguments);
    }

    public function testNonStringPropertyNameThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $arguments = [null, StringValidation::class];

        $this->call(new ValidationMetadata(), $arguments);
    }

    public function testInvalidValidationThrowsTypeConflictException()
    {
        $this->expectException(TypeConflictException::class);

        $arguments = ['property', new stdClass()];

        $this->call(new ValidationMetadata(), $arguments);
    }
}

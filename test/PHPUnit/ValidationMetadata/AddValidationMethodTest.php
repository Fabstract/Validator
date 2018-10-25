<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\ValidationMetadata;

use Fabstract\Component\UnitTest\MethodTestBase;
use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Validation\StringValidation;
use Fabstract\Component\Validator\ValidationMetadata;
use Fabstract\Component\Validator\Validator;

class AddValidationMethodTest extends MethodTestBase
{
    public function testAddEqualsGet()
    {
        $arguments = ['property', StringValidation::create()];

        /** @var ValidationMetadata $validation_metadata */
        $validation_metadata = $this->call(new ValidationMetadata(), $arguments);

        $return = $validation_metadata->getPropertyValidationLookup()['property'];

        $this->assertEquals(1, count($return));
        $this->assertInstanceOf(StringValidation::class, $return[0]);
    }

    public function testAddEqualsGetForString()
    {
        $arguments = ['property', StringValidation::class];

        /** @var ValidationMetadata $validation_metadata */
        $validation_metadata = $this->call(new ValidationMetadata(), $arguments);

        $return = $validation_metadata->getPropertyValidationLookup()['property'];

        $this->assertEquals(1, count($return));
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

        $arguments = ['property', new Validator()];

        $this->call(new ValidationMetadata(), $arguments);
    }
}

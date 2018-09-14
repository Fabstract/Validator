<?php

namespace Fabstract\Component\Validator\Test\PHPUnit\Validator;

use Fabstract\Component\Validator\Exception\TypeConflictException;
use Fabstract\Component\Validator\Test\PHPUnit\ClassThatDoesNotImplementValidatableInterface;
use Fabstract\Component\Validator\Test\PHPUnit\ClassWithNonExistentPropertyValidation;
use Fabstract\Component\Validator\Test\PHPUnit\ClassWithNoValidation;
use Fabstract\Component\Validator\Test\PHPUnit\ClassWithPrivateProperty;
use Fabstract\Component\Validator\Test\PHPUnit\ClassWithProtectedProperty;
use Fabstract\Component\Validator\Test\PHPUnit\ClassWithPublicProperty;
use Fabstract\Component\Validator\ValidationError;
use Fabstract\Component\Validator\Validator;

class ValidateMethodTest extends MethodTestBase
{
    #region correct arguments

    public function testClassWithNoValidationEqualsEmptyArray()
    {
        $arguments = [new ClassWithNoValidation()];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testValidPublicProperty()
    {
        $instance = new ClassWithPublicProperty();
        $instance->setProperty('string');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testInvalidPublicProperty()
    {
        $instance = new ClassWithPublicProperty();
        $instance->setProperty('');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(1, count($return));
    }

    public function testValidProtectedProperty()
    {
        $instance = new ClassWithProtectedProperty();
        $instance->setProperty('string');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testInvalidProtectedProperty()
    {
        $instance = new ClassWithProtectedProperty();
        $instance->setProperty('');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testValidPrivateProperty()
    {
        $instance = new ClassWithPrivateProperty();
        $instance->setProperty('string');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testInvalidPrivateProperty()
    {
        $instance = new ClassWithPrivateProperty();
        $instance->setProperty('');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testClassWithNonExistentPropertyValidation()
    {
        $instance = new ClassWithNonExistentPropertyValidation();

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testClassWithPropertyWithValidatableValidProperty()
    {
        $instance = new ClassWithNoValidation();
        $instance->property1 = new ClassWithPublicProperty();
        $instance->property1->setProperty('string');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testClassWithPropertyWithValidatableInvalidProperty()
    {
        $instance = new ClassWithNoValidation();
        $instance->property1 = new ClassWithPublicProperty();
        $instance->property1->setProperty('');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(1, count($return));
    }

    public function testClassWithArrayPropertyWithValidatableValidProperties()
    {
        $instance = new ClassWithNoValidation();
        $instance->property1 = [];
        $instance->property1[] = new ClassWithPublicProperty();
        $instance->property1[0]->setProperty('string');
        $instance->property1[] = new ClassWithPublicProperty();
        $instance->property1[1]->setProperty('string');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testClassWithArrayPropertyWithValidatableValidAndInvalidProperties()
    {
        $instance = new ClassWithNoValidation();
        $instance->property1 = [];
        $instance->property1[] = new ClassWithPublicProperty();
        $instance->property1[0]->setProperty('string');
        $instance->property1[] = new ClassWithPublicProperty();
        $instance->property1[1]->setProperty('');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(1, count($return));
    }

    public function testClassWithArrayPropertyWithValidatableInvalidProperties()
    {
        $instance = new ClassWithNoValidation();
        $instance->property1 = [];
        $instance->property1[] = new ClassWithPublicProperty();
        $instance->property1[0]->setProperty('');
        $instance->property1[] = new ClassWithPublicProperty();
        $instance->property1[1]->setProperty('');

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(2, count($return));
    }

    public function testArray()
    {
        $property1 = new ClassWithPublicProperty();
        $property1->setProperty('');

        $property2 = new ClassWithPublicProperty();
        $property2->setProperty('');

        $array = [$property1, $property2];

        $arguments = [$array];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(2, count($return));
    }

    public function testArrayOfArray()
    {
        $property1 = new ClassWithPublicProperty();
        $property1->setProperty('');

        $property2 = new ClassWithPublicProperty();
        $property2->setProperty('');

        $property3 = new ClassWithPublicProperty();
        $property3->setProperty('string');

        $property4 = new ClassWithPublicProperty();
        $property4->setProperty('string');

        $instance = new ClassWithNoValidation();
        $instance->property1 =
            [
                [$property1, $property2],
                [$property3, $property4]
            ];

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(2, count($return));
    }

    public function testPublicValidatableValidProperty()
    {
        $instance = new ClassWithPublicProperty();
        $instance->setProperty(' ');

        $property = new ClassWithPublicProperty();
        $property->setProperty(' ');

        $instance->setPublicValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testPublicValidatableInvalidProperty()
    {
        $instance = new ClassWithPublicProperty();
        $instance->setProperty(' ');

        $property = new ClassWithPublicProperty();
        $property->setProperty('');

        $instance->setPublicValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(1, count($return));
    }

    public function testPublicValidatableValidPropertyAndInvalidNotValidatableProperty()
    {
        $instance = new ClassWithPublicProperty();
        $instance->setProperty('');

        $property = new ClassWithPublicProperty();
        $property->setProperty(' ');

        $instance->setPublicValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(1, count($return));
    }

    public function testProtectedValidatableValidProperty()
    {
        $instance = new ClassWithProtectedProperty();
        $instance->setProperty(' ');

        $property = new ClassWithPublicProperty();
        $property->setProperty(' ');

        $instance->setProtectedValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testProtectedValidatableInvalidProperty()
    {
        $instance = new ClassWithProtectedProperty();
        $instance->setProperty(' ');

        $property = new ClassWithPublicProperty();
        $property->setProperty('');

        $instance->setProtectedValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testProtectedValidatableValidPropertyAndInvalidNotValidatableProperty()
    {
        $instance = new ClassWithProtectedProperty();
        $instance->setProperty('');

        $property = new ClassWithPublicProperty();
        $property->setProperty(' ');

        $instance->setProtectedValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testPrivateValidatableValidProperty()
    {
        $instance = new ClassWithPrivateProperty();
        $instance->setProperty(' ');

        $property = new ClassWithPublicProperty();
        $property->setProperty(' ');

        $instance->setPrivateValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testPrivateValidatableInvalidProperty()
    {
        $instance = new ClassWithPrivateProperty();
        $instance->setProperty(' ');

        $property = new ClassWithPublicProperty();
        $property->setProperty('');

        $instance->setPrivateValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testPrivateValidatableValidPropertyAndInvalidNotValidatableProperty()
    {
        $instance = new ClassWithPrivateProperty();
        $instance->setProperty('');

        $property = new ClassWithPublicProperty();
        $property->setProperty(' ');

        $instance->setPrivateValidatableProperty($property);

        $arguments = [$instance];

        $return = $this->call(new Validator(), $arguments);

        $this->assertEquals(0, count($return));
    }

    public function testErrorMessageAndPath()
    {
        $instance = new ClassWithNoValidation();
        $instance->property1 = [];
        $instance->property1[] = new ClassWithPublicProperty();
        $instance->property1[0]->setProperty('');
        $instance->property1[] = new ClassWithPublicProperty();
        $instance->property1[1]->setProperty('');

        $arguments = [$instance];

        /** @var ValidationError[] $error_list */
        $error_list = $this->call(new Validator(), $arguments);

        $this->assertEquals(2, count($error_list));
        $this->assertEquals('String must be at least 1 character(s) long.', $error_list[0]->getMessage());
        $this->assertEquals('property1.[0].public_property', $error_list[0]->getPropertyPathAsString());
        $this->assertEquals('property1.[1].public_property', $error_list[1]->getPropertyPathAsString());
    }

    public function testErrorMessage()
    {
        $property1 = new ClassWithPublicProperty();
        $property1->setProperty('');

        $property2 = new ClassWithPublicProperty();
        $property2->setProperty('');

        $arguments = [[$property1, $property2]];

        /** @var ValidationError[] $error_list */
        $error_list = $this->call(new Validator(), $arguments);

        $this->assertEquals(2, count($error_list));
        $this->assertEquals('[0].public_property', $error_list[0]->getPropertyPathAsString());
        $this->assertEquals('[1].public_property', $error_list[1]->getPropertyPathAsString());
    }

    #endregion

    #region incorrect arguments

    public function testNullThrowsTypeConflictException()
    {
        $arguments = [null];

        $this->expectException(TypeConflictException::class);

        $this->call(new Validator(), $arguments);
    }

    public function testClassThatDoesNotImplementValidatableInterfaceThrowsTypeConflictException()
    {
        $arguments = [new ClassThatDoesNotImplementValidatableInterface()];

        $this->expectException(TypeConflictException::class);

        $this->call(new Validator(), $arguments);
    }

    #endregion
}

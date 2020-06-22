<p align="center"><img src="https://avatars3.githubusercontent.com/u/36798053?s=200&v=4"></p>

<p align="center">
    <a href="https://travis-ci.org/Fabstract/Validator"><img src="https://api.travis-ci.org/Fabstract/Validator.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/fabstract/validator"><img src="https://poser.pugx.org/fabstract/validator/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/fabstract/validator"><img src="https://poser.pugx.org/fabstract/validator/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/fabstract/validator"><img src="https://poser.pugx.org/fabstract/validator/license.svg" alt="License"></a>
</p>

## Validator

This library introduces a small framework to validate certain variables against some rules. This library is especially useful
to validate client POST or form data in the backend side. 

This library is fully compatible with any framework and library. 
You can feel free to use it with Symfony, Laravel, or whichever framework you are using with nothing to fear for. 

## What Does It Do?

You can use this library to check if given value is valid string, array, integer, float, whether is belongs to certain set of values, objects and so on.
In case validation fails, library generates detailed messages as to why.

## Installation

**Note:** PHP 7.1 or higher is required.

1. Install [composer](https://getcomposer.org/download/).
2. Run `composer require fabstract/validator`.

## How to use

First you need to create a class that implements `ValidatableInterface` and set your validations. Let's call it `validatable`. 
Then you need an instance of `Validator`. 
Finally, set your `validatable` object's fields and validate it via `validator`.
Let's check below, we will use pre-defined validation classes (for instance, StringValidation class) for this example: 

```php
use Fabstract\Component\Validator\ValidatableInterface;
use Fabstract\Component\Validator\Validation\PatternValidation;
use Fabstract\Component\Validator\Validation\StringValidation;
use Fabstract\Component\Validator\ValidationMetadata;
use Fabstract\Component\Validator\Validator;

// Create class
class RegistrationPostData implements ValidatableInterface
{

    // Has to be 3-30 characters
    public $name = null;
    // Has to include at least a letter and number, be between 8-32 characters
    // so, it needs to match "^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,32}$"
    public $password = null;

    /**
     * @param ValidationMetadata $validation_metadata
     * @return void
     */
    public function configureValidationMetadata($validation_metadata)
    {
        $validation_metadata
            ->addValidation('name', StringValidation::create()
                ->setMinLength(3)
                ->setMaxLength(30))
            ->addValidation('password', PatternValidation::create('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,32}$/'));
    }
}

// Create validator instance, one instance is enough
$validator = new Validator();

// Let's create instance of our RegistrationPostData and fill it with POST data
$post_data = new RegistrationPostData();
$post_data->name = $_POST['name'];
$post_data->password = $_POST['password'];

// Validate the data
$validation_error_list = $validator->validate($post_data);

// Here if validation error list is empty, it means all your post data is valid.
$is_post_data_valid = count($validation_error_list) === 0;
if (!$is_post_data_valid) {
    // If not empty, you can see meaningful validation messages like below
    foreach ($validation_error_list as $validation_error) {
        echo $validation_error;
        echo PHP_EOL;
    }
}
```

Suppose you sent a data like below:
```
curl -X POST localhost -F'name=ac' -F'password=123'
```

You will see a result like below:

```
Validation failed at "name". Message is "String must be at least 3 character(s) long.".
Validation failed at "password". Message is "Value must match pattern /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,32}$/.".
```

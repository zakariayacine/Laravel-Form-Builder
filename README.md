# AutoFormGenerator is a Laravel package that streamlines form creation by automatically generating forms and their corresponding input fields using Artisan commands. Simplify repetitive tasks, reduce development time, and enhance productivity by generating fully customizable forms directly from the console. Perfect for CRUD applications and rapid prototyping.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/zakaria-yacine/laravel-form-builder.svg?style=flat-square)](https://packagist.org/packages/zakaria-yacine/laravel-form-builder)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/zakaria-yacine/laravel-form-builder/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/zakaria-yacine/laravel-form-builder/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/zakaria-yacine/laravel-form-builder/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/zakaria-yacine/laravel-form-builder/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/zakaria-yacine/laravel-form-builder.svg?style=flat-square)](https://packagist.org/packages/zakaria-yacine/laravel-form-builder)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/Laravel-Form-Builder.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/Laravel-Form-Builder)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require zakaria-yacine/laravel-form-builder
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="formbuilder"
```

This is the contents of the published config file:

```php
<?php

// config for ZakariaYacineBoucetta/LaravelFormBuilder
return [

    'inputTypes' => [
        'text', 'email', 'password', 'number', 'file', 'submit', 'button', 'radio', 'checkbox', 'hidden', 'date', 'select',
    ],

    'bootstrapClasses' => [
        'text' => 'form-control',
        'email' => 'form-control',
        'password' => 'form-control',
        'number' => 'form-control',
        'file' => 'form-control-file',
        'submit' => 'btn',
        'button' => 'btn',
        'radio' => 'form-check-input',
        'checkbox' => 'form-check-input',
        'hidden' => '',
        'date' => 'form-control',
        'select' => 'form-control',
    ],

    'tailwindClasses' => [
        'text' => 'block w-full px-4 py-2 border rounded-md',
        'email' => 'block w-full px-4 py-2 border rounded-md',
        'password' => 'block w-full px-4 py-2 border rounded-md',
        'number' => 'block w-full px-4 py-2 border rounded-md',
        'file' => 'block w-full px-4 py-2 border rounded-md',
        'submit' => 'px-4 py-2 rounded-md',
        'button' => 'px-4 py-2 rounded-md',
        'radio' => 'form-radio',
        'checkbox' => 'form-checkbox',
        'hidden' => '',
        'date' => 'block w-full px-4 py-2 border rounded-md',
        'select' => 'block w-full px-4 py-2 border rounded-md',
    ],

    'bootstrapButtonColors' => [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'success' => 'btn-success',
        'danger' => 'btn-danger',
        'warning' => 'btn-warning',
        'info' => 'btn-info',
        'light' => 'btn-light',
        'dark' => 'btn-dark',
    ],

    'tailwindButtonColors' => [
        'primary' => 'bg-blue-500 text-white',
        'secondary' => 'bg-gray-500 text-white',
        'success' => 'bg-green-500 text-white',
        'danger' => 'bg-red-500 text-white',
        'warning' => 'bg-yellow-500 text-black',
        'info' => 'bg-teal-500 text-white',
        'light' => 'bg-gray-100 text-black',
        'dark' => 'bg-gray-800 text-white',
    ],

    'fileTypes' => [
        'documents' => 'doc,docx,pdf',
        'images' => 'jpg,jpeg,png,gif',
        'videos' => 'mp4,mkv,avi',
    ],
];

```

## Usage

```php
php artisan make:form
```




## Credits

- [ZakariaYacineBoucetta](https://github.com/zakariayacine)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

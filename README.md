# Scrubber (Laravel Wrapper)
<p>
<a href="https://packagist.org/packages/clntdev/scrubber-laravel"><img src="https://poser.pugx.org/clntdev/scrubber-laravel/version" alt="Stable Build" /></a>
<a href="https://github.com/clnt/scrubber-laravel/actions"><img src="https://github.com/clnt/scrubber-laravel/actions/workflows/.github-actions.yml/badge.svg" alt="CI Status" /></a>
<a href="https://codecov.io/gh/clnt/scrubber-laravel"><img src="https://codecov.io/gh/clnt/scrubber-laravel/branch/production/graph/badge.svg?token=LZ3SIO46CN"/></a>
</p>
Scrubber (Laravel Wrapper) is a simple Laravel wrapper that adds in a Facade and some useful artisan commands around a minimal PHP package called [Scrubber](https://github.com/clnt/scrubber), this allows you to define a PHP configuration file which can help update database fields with various predefined or random values.

This is perfect for when you need a copy of a production database to work on and need to erase sensitive content.

## Installation

Install via composer by running: `composer require clntdev/scrubber-laravel`

Publish the package configuration to `config/scrubber.php` by running: `php artisan vendor:publish --tag=scrubber`

## Usage

The package relies on a valid PHP configuration file to function correctly, this file returns a simple array which maps out the tables, fields and their details so it knows which handler to use.

If using the default location, create a `scrubber.php` file at the root of your Laravel project. If using an alternative then set the absolute path in the `config/scrubber.php` file.

- A field can have a `primary_key` defined on it if you want to use an alternative column to fetch database records, the default is `id`.
- A field can have a `handler` defined on it if you wish to override the detected handler.
- A field can have a `type` defined on it which can be used to define the field as a certain data type such as `pid` for GDPR purposes (this is useful in the methods listed further down)

Here is an example configuration used in the unit tests:

```php
<?php

use ClntDev\Scrubber\Handlers\FakerHandler;

return [
    'users' => [
        'first_name' => [
            'primary_key' => 'id',
            'value' => 'faker.firstName',
            'type' => 'pid',
        ],
        'last_name' => [
            'value' => 'faker.lastName',
            'type' => 'pid',
        ],
        'email' => [
            'value' => 'faker.email',
            'handler' => FakerHandler::class,
            'type' => 'pid',
        ],
        'toggle' => [
            'value' => static fn (): bool => true,
        ],
    ],
];
```

### Facade

The scrubber package methods can be accessed through the `ClntDev\LaravelScrubber\Facades\Scrubber` class.

This wrapper uses the `DB` facade to perform any database updates and `Illuminate\Log\Logger` to log any error messages.
These are bound to the contracts detailed in the base package documentation which can be found [here.](https://github.com/clnt/scrubber)

### Methods

`Scrubber::run()` - This is the main method and will run all of the handlers from the parsed configuration file modifying the database.

`Scrubber::getFieldList(string $type = 'pid')` - This method will return an array of fields for the given type, this defaults to `pid`.

`Scrubber::getFieldListAsString(string $type = 'pid')` - This method will return a comma separated string of fields for the given type, this defaults to `pid`.

### Commands

`scrubber:run` - This command will run the `run()` scrubber method on the database.

`scrubber:fields --type=pid` - This command will return a comma separated string for the given type, if no `type` argument is specified then it will default to `pid`.

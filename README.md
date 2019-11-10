# env [![Build Status](https://travis-ci.com/flavioheleno/env.svg?branch=master)](https://travis-ci.com/flavioheleno/env)
Handle environment variables like a breeze.

## Install with composer

```shell
composer require flavioheleno/env
```

## Read or Required?

This library comes with two helpers:
 - `Env\Read`, which will try to read a variable and return its value or fallback to the `$default` value when the variable isn't set;
 - `Env\Required`, which will try to read a variable and return its value or throw an exception when the variable isn't set.

## Usage

You can **read** environment variables with:

```php
$value = Env\Read::asString('my_var', 'default_value');
```

On the other hand, you can **require** environment variables with:

```php
try {
  $value = Env\Required::asString('my_var');
} catch (RuntimeException $exception) {
  // handle exception
}
```

## Immutable environment

The library loads the environment variables into a internal copy on the first method call.

If you ever need to update the internal copy, you can do that with:

```php
Env\Read::updateEnv();
```

or:

```php
Env\Required::updateEnv();
```

## Available methods

All methods below are available in both the `Env\Read` and `Env\Required` helpers.

- **updateEnv**: Updates the internal env var copy;
- **asString**:: Returns the value as a string;
- **asArray**: Returns the values as an array (comma separated);
- **asInteger**: Returns the value as an integer;
- **asFloat**: Returns the value as a float;
- **asBool**: Returns the value as a boolean;
- **fromJson**: Returns the value as a json decoded value/object;
- **fromSerialized**: Returns the value as a unserialized value/object.

## License

This library is licensed under the [MIT License](LICENSE).

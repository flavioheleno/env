<?php
declare(strict_types = 1);

namespace Env;

/**
 * Environment Variable Reader.
 */
class Read {
  /**
   * Stores environment variables.
   *
   * @var array<string,mixed>
   */
  private static $env = [];

  /**
   * Loads environment variables into a static variable to be used by the class.
   *
   * @return void
   */
  private static function loadEnv(): void {
    if (empty(self::$env)) {
      self::$env = getenv();
    }
  }

  /**
   * Updates environment variables local copy.
   *
   * @return void
   */
  public static function updateEnv(): void {
    self::$env = [];
    self::loadEnv();
  }

  /**
   * Return an environment variable value as a string.
   *
   * @param string $varName
   * @param string $default
   *
   * @return string
   */
  public static function asString(string $varName, string $default = ''): string {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      return $default;
    }

    return (string)self::$env[$varName];
  }

  /**
   * Return an environment variable value as an array.
   *
   * @param string $varName
   * @param array<int,mixed>  $default
   *<
   * @return array<int,mixed>
   */
  public static function asArray(string $varName, array $default = []): array {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      return $default;
    }

    return explode(',', self::$env[$varName]);
  }

  /**
   * Return an environment variable value as an integer.
   *
   * @param string $varName
   * @param int    $default
   *
   * @return int
   */
  public static function asInteger(string $varName, int $default = 0): int {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      return $default;
    }

    return (int)self::$env[$varName];
  }

  /**
   * Return an environment variable value as a float.
   *
   * @param string $varName
   * @param float  $default
   *
   * @return float
   */
  public static function asFloat(string $varName, float $default = 0.0): float {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      return $default;
    }

    return (float)self::$env[$varName];
  }

  /**
   * Return an environment variable value as a boolean.
   *
   * @param string $varName
   * @param bool   $default
   *
   * @return bool
   */
  public static function asBool(string $varName, bool $default = false): bool {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      return $default;
    }

    return (bool)self::$env[$varName];
  }

  /**
   * Return a json-encoded environment variable value.
   *
   * @param string     $varName
   * @param mixed|null $default
   *
   * @return mixed|null
   */
  public static function fromJson(string $varName, $default = null) {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      return $default;
    }

    return json_decode(self::$env[$varName], true);
  }

  /**
   * Return a serialize-encoded environment variable.
   *
   * @param string     $varName
   * @param mixed|null $default
   *
   * @return mixed|null
   */
  public static function fromSerialized(string $varName, $default = null) {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      return $default;
    }

    return unserialize(self::$env[$varName]);
  }
}


<?php
declare(strict_types = 1);

namespace Env;

/**
 * Environment Variable Reader.
 */
class Read {
  /**
   * Return an environment variable value as a string.
   *
   * @param string $varName
   * @param string $default
   *
   * @return string
   */
  public static function asString(string $varName, string $default = '') : string {
    $value = getenv($varName);
    if ($value === false) {
      return $default;
    }

    return (string) $value;
  }

  /**
   * Return an environment variable value as an array.
   *
   * @param string $varName
   * @param array  $default
   *
   * @return array
   */
  public static function asArray(string $varName, array $default = []) : array {
    $value = getenv($varName);
    if ($value === false) {
      return $default;
    }

    return explode(',', $value);
  }

  /**
   * Return an environment variable value as an integer.
   *
   * @param string $varName
   * @param int    $default
   *
   * @return int
   */
  public static function asInteger(string $varName, int $default = 0) : int {
    $value = getenv($varName);
    if ($value === false) {
      return $default;
    }

    return (int) $value;
  }

  /**
   * Return an environment variable value as a float.
   *
   * @param string $varName
   * @param float  $default
   *
   * @return float
   */
  public static function asFloat(string $varName, float $default = 0.0) : float {
    $value = getenv($varName);
    if ($value === false) {
      return $default;
    }

    return (float) $value;
  }

  /**
   * Return an environment variable value as a boolean.
   *
   * @param string $varName
   * @param bool   $default
   *
   * @return bool
   */
  public static function asBool(string $varName, bool $default = false) : bool {
    $value = getenv($varName);
    if ($value === false) {
      return $default;
    }

    return (bool) $value;
  }

  /**
   * Return an environment variable value as a mixed value.
   *
   * @param string     $varName
   * @param mixed|null $default
   *
   * @return mixed|null
   */
  public static function asMixed(string $varName, $default = null) {
    $value = getenv($varName);
    if ($value === false) {
      return $default;
    }

    return $value;
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
    $value = getenv($varName);
    if ($value === false) {
      return $default;
    }

    return json_decode($value, true);
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
    $value = getenv($varName);
    if ($value === false) {
      return $default;
    }

    return unserialize($value);
  }
}


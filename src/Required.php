<?php
declare(strict_types = 1);

namespace Env;

use RuntimeException;

/**
 * Environment Variable Reader.
 */
class Required {
  /**
   * Stores environment variables.
   *
   * @var array
   */
  private static $env = [];

  /**
   * Loads environment variables into a static variable to be used by the class.
   *
   * @return void
   */
  private static function loadEnv() : void {
    if (empty(self::$env)) {
      self::$env = getenv();
    }
  }

  /**
   * Updates environment variables local copy.
   *
   * @return void
   */
  public static function updateEnv() : void {
    self::$env = [];
    self::loadEnv();
  }

  /**
   * Return an environment variable value as a string or throws an exception if it is not set.
   *
   * @param string $varName
   *
   * @return string
   */
  public static function asString(string $varName) : string {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      throw new RuntimeException(sprintf('Env\Require::asString: "%s" is not set', $varName));
    }

    return (string) self::$env[$varName];
  }

  /**
   * Return an environment variable value as an array or throws an exception if it is not set.
   *
   * @param string $varName
   *
   * @return array
   */
  public static function asArray(string $varName) : array {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      throw new RuntimeException(sprintf('Env\Require::asArray: "%s" is not set', $varName));
    }

    return explode(',', self::$env[$varName]);
  }

  /**
   * Return an environment variable value as an integer or throws an exception if it is not set.
   *
   * @param string $varName
   *
   * @return int
   */
  public static function asInteger(string $varName) : int {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      throw new RuntimeException(sprintf('Env\Require::asInteger: "%s" is not set', $varName));
    }

    return (int) self::$env[$varName];
  }

  /**
   * Return an environment variable value as a float or throws an exception if it is not set.
   *
   * @param string $varName
   *
   * @return float
   */
  public static function asFloat(string $varName) : float {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      throw new RuntimeException(sprintf('Env\Require::asFloat: "%s" is not set', $varName));
    }

    return (float) self::$env[$varName];
  }

  /**
   * Return an environment variable value as a boolean or throws an exception if it is not set.
   *
   * @param string $varName
   *
   * @return bool
   */
  public static function asBool(string $varName) : bool {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      throw new RuntimeException(sprintf('Env\Require::asBool: "%s" is not set', $varName));
    }

    return (bool) self::$env[$varName];
  }

  /**
   * Return a json-encoded environment variable value or throws an exception if it is not set.
   *
   * @param string $varName
   *
   * @return mixed|null
   */
  public static function fromJson(string $varName) {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      throw new RuntimeException(sprintf('Env\Require::fromJson: "%s" is not set', $varName));
    }

    return json_decode(self::$env[$varName], true);
  }

  /**
   * Return a serialize-encoded environment variable or throws an exception if it is not set.
   *
   * @param string $varName
   *
   * @return mixed|null
   */
  public static function fromSerialized(string $varName) {
    self::loadEnv();
    if (isset(self::$env[$varName]) === false) {
      throw new RuntimeException(sprintf('Env\Require::fromSerialized: "%s" is not set', $varName));
    }

    return unserialize(self::$env[$varName]);
  }
}


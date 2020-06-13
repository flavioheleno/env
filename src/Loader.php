<?php
declare(strict_types = 1);

namespace Env;

/**
 * Environment Variable Loader.
 */
abstract class Loader {
  /**
   * Stores environment variables.
   *
   * @var array<string,mixed>
   */
  protected static $env = [];

  /**
   * Loads environment variables into a static variable to be used by the class.
   *
   * @return void
   */
  protected static function loadEnv(): void {
    if (empty(self::$env)) {
      self::$env = $_ENV ?: getenv();
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
}

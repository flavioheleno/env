<?php
declare(strict_types=1);

namespace Test;

use Env\Loader;
use PHPUnit\Framework\TestCase;

final class LoaderTest extends TestCase {
  private function getTestDummy(): Loader {
    return new class extends Loader {
      public static function forceLoad(): void {
        self::loadEnv();
      }

      /**
       * @return array<string,mixed>
       */
      public static function getEnv(): array {
        return self::$env;
      }
    };
  }

  public function testLoadFromEnvVar(): void {
    $_ENV = [
      'a' => 'b',
      'c' => 1
    ];

    $testDummy = $this->getTestDummy();
    $testDummy::forceLoad();
    $this->assertEquals($_ENV, $testDummy::getEnv());
  }

  public function testLoadFromGetenv(): void {
    $_ENV = [];
    $vars = [
      'a' => 'b',
      'c' => 'd'
    ];
    foreach ($vars as $key => $value) {
      putenv(sprintf('%s=%s', $key, $value));
    }

    $testDummy = $this->getTestDummy();
    $testDummy::forceLoad();
    $env = $testDummy::getEnv();
    $this->assertSame($vars['a'], $env['a']);
    $this->assertSame($vars['c'], $env['c']);
  }

  public function testUpdateEnvFromEnvVar(): void {
    $_ENV = [];
    $testDummy = $this->getTestDummy();
    $testDummy::forceLoad();
    $this->assertEquals(getenv(), $testDummy::getEnv());

    $_ENV = [
      'd' => 'e'
    ];
    $testDummy::updateEnv();
    $this->assertEquals($_ENV, $testDummy::getEnv());
  }

  public function testUpdateEnvFromGetenv(): void {
    $testDummy = $this->getTestDummy();
    $testDummy::forceLoad();
    $this->assertEquals(getenv(), $testDummy::getEnv());

    $vars = [
      'f' => 'g'
    ];
    foreach ($vars as $key => $value) {
      putenv(sprintf('%s=%s', $key, $value));
    }

    $testDummy::updateEnv();
    $env = $testDummy::getEnv();
    $this->assertSame($vars['f'], $env['f']);
  }
}

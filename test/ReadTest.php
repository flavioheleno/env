<?php
declare(strict_types=1);

namespace Test;

use Env\Read;
use PHPUnit\Framework\TestCase;

final class ReadTest extends TestCase {
  public function testUpdateEnv(): void {
    $val = Read::asString('testUpdate', 'defaultVal');
    $this->assertSame('defaultVal', $val);

    putenv('testUpdate=updatedVal');
    Read::updateEnv();

    $val = Read::asString('testUpdate', 'defaultVal');
    $this->assertSame('updatedVal', $val);
  }

  public function testReadAsStringDefaultValue(): void {
    $val = Read::asString('testAsString', 'defaultVal');
    $this->assertSame('defaultVal', $val);
  }

  public function testReadAsString(): void {
    putenv('testAsString=myVal');

    $val = Read::asString('testAsString', 'defaultVal');
    $this->assertSame('myVal', $val);
  }

  public function testReadAsArrayDefaultValue(): void {
    $val = Read::asArray('testAsArray', ['defVal1', 'defVal2']);
    $this->assertSame(['defVal1', 'defVal2'], $val);
  }

  public function testReadAsArray(): void {
    putenv('testAsArray=myVal1,myVal2');

    $val = Read::asArray('testAsArray');
    $this->assertSame(['myVal1', 'myVal2'], $val);
  }

  public function testReadAsReadIntegerDefaultValue(): void {
    $val = Read::asInteger('testAsInteger', 4321);
    $this->assertSame(4321, $val);
  }

  public function testReadAsInteger(): void {
    putenv('testAsInteger=1234');

    $val = Read::asInteger('testAsInteger');
    $this->assertSame(1234, $val);
  }

  public function testReadAsFloatDefaultValue(): void {
    $val = Read::asFloat('testAsFloat', 1.2);
    $this->assertSame(1.2, $val);
  }

  public function testReadAsFloat(): void {
    putenv('testAsFloat=0.4');

    $val = Read::asFloat('testAsFloat');
    $this->assertSame(0.4, $val);
  }

  public function testReadAsBoolDefaultValue(): void {
    $val = Read::asBool('testAsBool', false);
    $this->assertSame(false, $val);
  }

  public function testReadAsBool(): void {
    putenv('testAsBool=1');

    $val = Read::asBool('testAsBool');
    $this->assertSame(true, $val);
  }

  public function testRequiredFromJsonDefaultValue(): void {
    $val = Read::fromJson('testFromJson', ['default' => 'value']);
    $this->assertSame(['default' => 'value'], $val);
  }

  public function testReadFromJson(): void {
    putenv('testFromJson={"a":1,"b":"c"}');

    $val = Read::fromJson('testFromJson');
    $this->assertSame(['a' => 1, 'b' => 'c'], $val);
  }

  public function testReadFromSerializedDefaultValue(): void {
    $val = Read::fromSerialized('testFromSerialized', ['default' => 'value']);
    $this->assertSame(['default' => 'value'], $val);
  }

  public function testReadFromSerialized(): void {
    putenv('testFromSerialized=a:2:{s:1:"a";i:1;s:1:"b";s:1:"c";}');

    $val = Read::fromSerialized('testFromSerialized');
    $this->assertSame(['a' => 1, 'b' => 'c'], $val);
  }
}

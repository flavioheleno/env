<?php
declare(strict_types=1);

namespace Test;

use Env\Required;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class RequiredTest extends TestCase {
  public function testUpdateEnv() : void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('"testUpdate" is not set');
    $val = Required::asString('testUpdate');

    putenv('testUpdate=updatedVal');
    Required::updateEnv();

    $val = Required::asString('testUpdate');
    $this->assertSame('updatedVal', $val);
  }

  public function testRequiredAsStringUnsetValue() : void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('"testAsString" is not set');
    $val = Required::asString('testAsString');
  }

  public function testRequiredAsString() : void {
    putenv('testAsString=myVal');

    $val = Required::asString('testAsString');
    $this->assertSame('myVal', $val);
  }

  public function testRequiredAsArrayUnsetValue() : void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('"testAsArray" is not set');
    $val = Required::asArray('testAsArray');
  }

  public function testRequiredAsArray() : void {
    putenv('testAsArray=myVal1,myVal2');

    $val = Required::asArray('testAsArray');
    $this->assertSame(['myVal1', 'myVal2'], $val);
  }

  public function testRequiredAsIntegerUnsetValue() : void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('"testAsInteger" is not set');
    $val = Required::asInteger('testAsInteger');
  }

  public function testRequiredAsInteger() : void {
    putenv('testAsInteger=1234');

    $val = Required::asInteger('testAsInteger');
    $this->assertSame(1234, $val);
  }

  public function testRequiredAsFloatUnsetValue() : void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('"testAsFloat" is not set');
    $val = Required::asFloat('testAsFloat');
  }

  public function testRequiredAsFloat() : void {
    putenv('testAsFloat=0.4');

    $val = Required::asFloat('testAsFloat');
    $this->assertSame(0.4, $val);
  }

  public function testRequiredAsBoolUnsetValue() : void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('"testAsBool" is not set');
    $val = Required::asBool('testAsBool');
  }

  public function testRequiredAsBool() : void {
    putenv('testAsBool=1');

    $val = Required::asBool('testAsBool');
    $this->assertSame(true, $val);
  }

  public function testRequiredFromJsonUnsetValue() : void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('"testFromJson" is not set');
    $val = Required::fromJson('testFromJson');
  }

  public function testRequiredFromJson() : void {
    putenv('testFromJson={"a":1,"b":"c"}');

    $val = Required::fromJson('testFromJson');
    $this->assertSame(['a' => 1, 'b' => 'c'], $val);
  }

  public function testRequiredFromSerializedUnsetValue() : void {
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('"testFromSerialized" is not set');
    $val = Required::fromSerialized('testFromSerialized');
  }

  public function testRequiredFromSerialized() : void {
    putenv('testFromSerialized=a:2:{s:1:"a";i:1;s:1:"b";s:1:"c";}');

    $val = Required::fromSerialized('testFromSerialized');
    $this->assertSame(['a' => 1, 'b' => 'c'], $val);
  }
}

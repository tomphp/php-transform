# Changelog

### 0.0.1 (2016-01-10)

  * Added: `Filter::isNull()`
  * Added: `Filter::notNull()`
  * Added: `Filter::isSameAs($expected)`
  * Added: `Filter::notSameAs($expected)`
  * Added: `Filter::isLike($expected)`
  * Added: `Filter::notLike($expected)`
  * Added: `Filter::hasMethodReturning(string $methodName, $expected, bool $strict = true)`
  * Added: `Filter::notHasMethodReturning(string $methodName, $expected, bool strict = true)`
  * Added: `Transform::callMethod(string $methodName)`
  * Added: `Transform::getEntry(string|string[] $name)`
  * Added: `Transform::argumentTo(callable $callable)`

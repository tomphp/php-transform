# Changelog

### dev-master

  * Deprecated: `getEntry($name)`
  * Added: `getElement($name)` - previously `getEntry()`
  * Added: Make it possible to pass arguments to `callMethod($name, ...$args)`

### 0.1.2 (2016-01-11)

 * Fix: Autoloader issue (case sensitive file name)

### 0.1.1 (2016-01-11)

  * Added: `getProperty($name)`
  * Added: `chain(...$fns)`

### 0.1.0 (2016-01-11)

  * Changed: Rename library to `Transform`
  * Changed: Use function instead of static methods
  * Removed: `Filter::isNull()`
  * Removed: `Filter::notNull()`
  * Removed: `Filter::isSameAs($expected)`
  * Removed: `Filter::notSameAs($expected)`
  * Removed: `Filter::isLike($expected)`
  * Removed: `Filter::notLike($expected)`
  * Removed: `Filter::hasMethodReturning(string $methodName, $expected, bool $strict = true)`
  * Removed: `Filter::notHasMethodReturning(string $methodName, $expected, bool strict = true)`

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

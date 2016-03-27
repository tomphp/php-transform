# Changelog
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).<Paste>

## [Unreleased]

## [0.2.4] - 2015-03-27
### Added
- `valueOrDefault()`

## [0.2.3] - 2016-03-22
### Added
- `concat()`

## [0.2.2] - 2016-03-18
### Added
- `newInstance()`

## [0.2.1] - 2016-03-13
### Added
- `callStatic()`

## [0.2.0] - 2016-02-07
### Added
- Type checking with exceptions thrown on error.

## [0.1.6] - 2016-01-14
### Added
- Argument list for `argumentTo($callable, $arguments)`.

## [0.1.5] - 2016-01-14
### Added
- `Builder` for prettier object/array traversal.
- `__()` to create a builder instance.

## [0.1.4] - 2016-01-13
### Added
- `prepend($prefix)` and `append($prefix)`.

### Fixed
- `getProperty($name)` was incorrectly implemented and tested.

## [0.1.3] - 2016-01-12
### Added
- `getElement($name)` - previously `getEntry()`.
- Make it possible to pass arguments to `callMethod($name, ...$args)`.

### Deprecated
- `getEntry($name)`.

## [0.1.2] - 2016-01-11
### Fixed
- Autoloader issue (case sensitive file name).

## [0.1.1] - 2016-01-11
### Added
- `getProperty($name)`.
- `chain(...$fns)`.

## [0.1.0] - 2016-01-11
### Changed
- Rename library to `Transform`.
- Use function instead of static methods.

### Removed
- `Filter::isNull()`.
- `Filter::notNull()`.
- `Filter::isSameAs($expected)`.
- `Filter::notSameAs($expected)`.
- `Filter::isLike($expected)`.
- `Filter::notLike($expected)`.
- `Filter::hasMethodReturning(string $methodName, $expected, bool $strict = true)`.
- `Filter::notHasMethodReturning(string $methodName, $expected, bool strict = true)`.

## [0.0.1] - 2016-01-10
### Added
- `Filter::isNull()`.
- `Filter::notNull()`.
- `Filter::isSameAs($expected)`.
- `Filter::notSameAs($expected)`.
- `Filter::isLike($expected)`.
- `Filter::notLike($expected)`.
- `Filter::hasMethodReturning(string $methodName, $expected, bool $strict = true)`.
- `Filter::notHasMethodReturning(string $methodName, $expected, bool strict = true)`.
- `Transform::callMethod(string $methodName)`.
- `Transform::getEntry(string|string[] $name)`.
- `Transform::argumentTo(callable $callable)`.

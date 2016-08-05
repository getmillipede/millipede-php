Millipede PHP [![Build Status](https://travis-ci.org/getmillipede/millipede-php.svg?branch=master)](https://travis-ci.org/getmillipede/millipede-php)
=================

PHP version of [getmillipede](https://github.com/getmillipede/) with a PHP twist to it.

Highlights
-------

- Treats Millipede Configuration as Immutable Value Objects
- Fully documented
- Framework agnostic
- Composer ready, [PSR-2], and [PSR-4] compliant

System Requirements
-------

You need **PHP >= 5.5.0** but the latest stable version of PHP or HHVM is recommended.

Usage
-------

Creating a simple millipede with its default settings:

```php
use Millipede\Millipede;

$millipede = new Millipede();
echo $millipede, PHP_EOL;
```

will generate the following on a **CLI output**

```
    ╚⊙ ⊙╝
  ╚═(███)═╝
 ╚═(███)═╝
╚═(███)═╝
 ╚═(███)═╝
  ╚═(███)═╝
   ╚═(███)═╝
    ╚═(███)═╝
   ╚═(███)═╝
  ╚═(███)═╝
 ╚═(███)═╝
╚═(███)═╝
 ╚═(███)═╝
  ╚═(███)═╝
   ╚═(███)═╝
    ╚═(███)═╝
   ╚═(███)═╝
  ╚═(███)═╝
 ╚═(███)═╝
╚═(███)═╝
 ╚═(███)═╝
```

Of course you can be more specific in your configuration settings

```php
use Millipede\Config;
use Millipede\Millipede;

$config = (new Config())->withSize(5)->withComment('Hello world !');
$millipede = new Millipede($config);
echo $millipede, PHP_EOL;
```

will generate the following on a **CLI output**

```
Hello world !

    ╚⊙ ⊙╝
  ╚═(███)═╝
 ╚═(███)═╝
╚═(███)═╝
 ╚═(███)═╝
  ╚═(███)═╝

```

For advance usage if you are requesting bigger size, the `Millipede` object implements the `IteratorAggregate` interface and return an `Generator` as to allow low memory usage while generating huge millipede.


```php
use Millipede\Config;
use Millipede\Millipede;

$config = (new Config())->withSize(5)->withComment('Hello world !');
$millipede = new Millipede($config);
foreach ($millipede as $part) {
	echo $part, PHP_EOL;
}
```

will also generate the following on a **CLI output**

```
Hello world !

    ╚⊙ ⊙╝
  ╚═(███)═╝
 ╚═(███)═╝
╚═(███)═╝
 ╚═(███)═╝
  ╚═(███)═╝

```

The `Config` class properties are listed below:

```php
<?php

public function Config::getComment() : string    //return the commented text
public function Config::getHeadBlock() : string  //return the head block
public function Config::getBodyBlock() : string  //return the body block
public function Config::getSize() : int          //return the millipede size
public function Config::getWidth() : int         //return the millipede width
public function Config::getCurve() : int         //return the millipede curve
public function Config::isOpposite(): bool       //tell whether the millipede curve is opposite
public function Config::isReverse() : bool       //tell whether the millipede is reversed
```

Modifying the `Config` class properties

To modify/update the class properties you must use the following modifying methods:

```php
<?php

public function Config::withComment(string $comment) : static
public function Config::withHeadBlock() : static
public function Config::withBodyBlock() : static
public function Config::withSize(int $size): static
public function Config::withWidth(int $width) : static
public function Config::withCurve(int $curve) : static
public function Config::withOpposite(bool $status) : static
public function Config::withReverse(bool $status) : static
```

Since the `Config` class is immutable you can chain each modifying methods to simplify Config creation and/or modification.

```php
<?php

use Millipede\Config;

$config = (new Config())
    ->withCurve(4)
    ->withSize(10)
    ->withComment('Hello World!')
    ->withOpposite(true)
    ->withReverse(true)
    ->withWidth(7)
    ->withBodyBlock('\uD83D\uDC1F')
;

echo new Millipede($config);

```

will return

```

 Hello World!

   ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
    ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
   ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
  ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
 ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
 ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
  ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
   ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
    ╔═(🐟🐟🐟🐟🐟🐟🐟)═╗
       ╔⊙     ⊙╗


```

Install
-------

Install `Millipede` using Composer.

```
$ composer require millipede/millipede
```

Testing
-------

`Millipede` has a [PHPUnit](https://phpunit.de) test suite and a coding style compliance test suite using [PHP CS Fixer](http://cs.sensiolabs.org/). To run the tests, run the following command from the project folder.

``` bash
$ composer test
```

Contributing
-------

Contributions are welcome and will be fully credited.

Credits
-------

- [All Contributors](https://github.com/getmillipede/millipede-php/graphs/contributors)

Support
-------

* [Stack Overflow](http://stackoverflow.com/questions/tagged/millipede)
* [Twitter](https://twitter.com/getmillipede)
* [#getmillipede](http://webchat.freenode.net?channels=%23getmillipede&uio=d4) on Freenode

TODO
-------

* adding more options in the [Config class](src/Config.php)
* enable easier output on a browser (support for HTML rendering)

License
-------

[MIT](LICENSE)


[PSR-2]: http://www.php-fig.org/psr/psr-2/
[PSR-4]: http://www.php-fig.org/psr/psr-4/

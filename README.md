Millipede PHP [![Build Status](https://travis-ci.org/getmillipede/millipede-php.svg?branch=master)](https://travis-ci.org/getmillipede/millipede-php)
=================

PHP version of [getmillipede](https://github.com/getmillipede/) with a PHP twist to it.

Highlights
-------

- Treats Millipede as Immutable Value Objects
- Fully documented
- Framework agnostic
- Composer ready, [PSR-2], and [PSR-4] compliant

System Requirements
-------

You need **PHP >= 5.6.0** but the latest stable version of PHP or HHVM is recommended.

Components
-------

- the PHP millipede CLI ./bin/millipede-php
- the PHP Library

CLI usage
-------

```
$ php millipede-php -h

NAME:
   millipede-php - Print a beautiful millipede

USAGE:
   millipede-php [options...]

AUTHOR(S):
   Millipede crew <https://github.com/getmillipede/millipede-php>

OPTIONS:
   --reverse, -r  reverse the millipede
   --opposite, -o go the opposite direction
   --skin         millipede skin pattern (one character) [default: "█"]
   --head         millipede head pattern (one character) [default: " "]
   --color        millipede color [default: "white"]
                  The color options supports the POSIX colors: 'white', 'red', 'yellow', 'green', 'cyan', 'blue', 'magenta'
                  as well as two specific compositions random, rainbow
   --width        millipede width [default: 3]
   --size         millipede size [default: 20]
   --curve        millipede curve size [default: 4]
   --comment       comment from the millipede [default: " "]
   --help, -h     show help
```

### Examples

```
$ php millipede-php --size 10

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

```

```
$ php millipede-php --size 10 -r -o

    ╔═(███)═╗
     ╔═(███)═╗
    ╔═(███)═╗
   ╔═(███)═╗
  ╔═(███)═╗
 ╔═(███)═╗
  ╔═(███)═╗
   ╔═(███)═╗
    ╔═(███)═╗
     ╔═(███)═╗
        ╔⊙ ⊙╗

```

```
$ php millipede-php --size 10 -r --curve 0 --color yellow

 ╔═(███)═╗
 ╔═(███)═╗
 ╔═(███)═╗
 ╔═(███)═╗
 ╔═(███)═╗
 ╔═(███)═╗
 ╔═(███)═╗
 ╔═(███)═╗
 ╔═(███)═╗
 ╔═(███)═╗
   ╔⊙ ⊙╗
```

Will appear yellow in a POSIX compliant CLI.


Library Usage
-------

Rendering a simple millipede with its default settings:

```php
use Millipede\Renderer;

$renderer = new Renderer();
echo $renderer, PHP_EOL;
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
use Millipede\Millipede;
use Millipede\Renderer;

$millipede = (new Millipede())->withSize(5)->withComment('Hello world !');
echo new Renderer($millipede), PHP_EOL;
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
use Millipede\Millipede;
use Millipede\Renderer;

$millipede = (new Millipede())->withSize(5)->withComment('Hello world !');
$renderer = new Renderer($config);
foreach ($renderer as $piece) {
	echo $piece, PHP_EOL;
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

The `Millipede` class properties are listed below:

```php
<?php

public function Millipede::getComment() : string //return the commented text
public function Millipede::getHead() : string    //return the head pattern (a single character)
public function Millipede::getSkin() : string    //return the body skin pattern (a single character)
public function Millipede::getSize() : int       //return the millipede size
public function Millipede::getWidth() : int      //return the millipede width
public function Millipede::getCurve() : int      //return the millipede curve
public function Millipede::isOpposite(): bool    //tell whether the millipede curve is opposite
public function Millipede::isReverse() : bool    //tell whether the millipede is reversed
```

Modifying the `Millipede` class properties

To modify/update the class properties you must use the following modifying methods:

```php
<?php

public function Millipede::withComment(string $comment) : static
public function Millipede::withHead(string $head) : static //a single character or a Unicode character
public function Millipede::withSkin(string $skin) : static //a single character or a Unicode character
public function Millipede::withSize(int $size): static
public function Millipede::withWidth(int $width) : static
public function Millipede::withCurve(int $curve) : static
public function Millipede::withOpposite(bool $status) : static
public function Millipede::withReverse(bool $status) : static
```

Since the `Millipede` class is immutable you can chain each modifying methods to simplify Config creation and/or modification.

```php
<?php

use Millipede\Millipede;

$millipede = (new Millipede())
    ->withCurve(4)
    ->withSize(10)
    ->withComment('Chaud devant! Mon beau millepatte doit passer!')
    ->withOpposite(true)
    ->withReverse(true)
    ->withWidth(7)
    ->withSkin('\uD83D\uDC1F')
;

echo new Renderer($millipede);

```

will return

```

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

 Chaud devant! Mon beau millepatte doit passer!

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

Millipede PHP
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
<?php

namespace Millipede\Test;

use Millipede\Config;
use Millipede\Millipede;
use PHPUnit_Framework_TestCase as TestCase;

class MillipedeTest extends TestCase
{
    public function testSimpleUsage()
    {
        $expected = <<<EOF
Hello World!

    ╚⊙ ⊙╝
  ╚═(███)═╝
 ╚═(███)═╝
╚═(███)═╝
 ╚═(███)═╝
  ╚═(███)═╝


EOF;
        $millipede = new Millipede((new Config())->withSize(5)->withComment('Hello World!'));
        $this->assertSame($expected, (string) $millipede);
    }
}

<?php

namespace MillipedeTest;

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
        $millipede = new Millipede((new Config())->withCurve(4)->withSize(5)->withComment('Hello World!'));
        $this->assertSame($expected, (string) $millipede);
    }

    public function testSimpleUsageWithoutCurve()
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
        $millipede = new Millipede((new Config())->withCurve(0)->withSize(5)->withComment('Hello World!'));
        $this->assertSame($expected, (string) $millipede);
    }


    public function testComplexUsage()
    {
        $expected = <<<EOF

 Hello World!

   ╔═(███████)═╗
    ╔═(███████)═╗
   ╔═(███████)═╗
  ╔═(███████)═╗
 ╔═(███████)═╗
╔═(███████)═╗
 ╔═(███████)═╗
  ╔═(███████)═╗
   ╔═(███████)═╗
    ╔═(███████)═╗
       ╔⊙     ⊙╗


EOF;
        $config = (new Config())
          ->withCurve(4)
          ->withSize(10)
          ->withComment('Hello World!')
          ->withOpposite(true)
          ->withReverse(true)
          ->withWidth(7)
      ;

        $millipede = new Millipede($config);
        $this->assertSame($expected, (string) $millipede);
    }
}

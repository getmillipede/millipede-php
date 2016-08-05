<?php

namespace MillipedeTest;

use Millipede\Millipede;
use Millipede\Renderer;
use PHPUnit_Framework_TestCase as TestCase;

class RendererTest extends TestCase
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
        $millipede = new Renderer((new Millipede())->withCurve(4)->withSize(5)->withComment('Hello World!'));
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
        $millipede = new Renderer((new Millipede())->withCurve(0)->withSize(5)->withComment('Hello World!'));
        $this->assertSame($expected, (string) $millipede);
    }


    public function testComplexUsage()
    {
        $expected = <<<EOF

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

 Hello World!


EOF;
        $config = (new Millipede())
          ->withCurve(4)
          ->withSize(10)
          ->withComment('Hello World!')
          ->withOpposite(true)
          ->withReverse(true)
          ->withWidth(7)
      ;

        $millipede = new Renderer($config);
        $this->assertSame($expected, (string) $millipede);
    }
}

<?php

namespace MillipedeTest;

use Millipede\Cli;
use Millipede\Millipede;
use Millipede\Renderer;
use PHPUnit_Framework_TestCase as TestCase;

class CliTest extends TestCase
{
    public function testFormat()
    {
        $esc = chr(27);
        $text = '<<bold>>bold%percent<<reset>>';
        $expect = " {$esc}[1mbold%percent{$esc}[0m".PHP_EOL;
        $actual = Cli::outln($text);
        $this->assertSame($expect, $actual);
    }

    public function testCreateNewInstance()
    {
        $this->assertInstanceOf(Cli::class, Cli::createFromRainbow());
        $this->assertInstanceOf(Cli::class, Cli::createFromRandom());
        $this->assertInstanceOf(Cli::class, new Cli());
    }

    public function testInvoke()
    {
        $res = (new Cli())->__invoke(new Renderer(new Millipede()));
        $this->assertInstanceOf('\Generator', $res);
        $this->assertCount(23, iterator_to_array($res));
    }
}

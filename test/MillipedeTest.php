<?php

namespace MillipedeTest;

use Millipede\Millipede;
use PHPUnit_Framework_TestCase as TestCase;
use StdClass;

class MillipedeTest extends TestCase
{
    private $config;

    public function setUp()
    {
        $this->config = new Millipede();
    }

    public function testNewInstance()
    {
        $this->assertSame('', $this->config->getComment());
        $this->assertSame(20, $this->config->getSize());
        $this->assertSame(3, $this->config->getWidth());
        $this->assertSame(4, $this->config->getCurve());
        $this->assertSame(' ', $this->config->getHead());
        $this->assertSame('█', $this->config->getSkin());
        $this->assertFalse($this->config->isOpposite());
        $this->assertFalse($this->config->isReverse());
        $this->assertInternalType('array', $this->config->toArray());
    }

    /**
     * @dataProvider providerSetSize
     */
    public function testSetSize($size, $expected)
    {
        $newSize = $this->config->withSize($size)->getSize();
        $this->assertSame($expected, $newSize);
    }

    public function providerSetSize()
    {
        return [
            '0 size' => [0, 20],
            'negative size' => [-23, 20],
            'basic usage' => [23, 23],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetSizeThrowsException()
    {
        $this->config->withSize(new StdClass());
    }

    /**
     * @dataProvider providerSetComment
     */
    public function testSetComment($comment, $expected)
    {
        $this->assertSame($expected, $this->config->withComment($comment)->getComment());
    }

    public function providerSetComment()
    {
        return [
            'empty string' => ['', ''],
            'basic usage' => ['Hello World!', 'Hello World!'],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetCommentThrowsException()
    {
        $this->config->withComment(12);
    }

    /**
     * @dataProvider providerSetCurve
     */
    public function testSetCurve($size, $expected)
    {
        $this->assertSame($expected, $this->config->withCurve($size)->getCurve());
    }

    public function providerSetCurve()
    {
        return [
            '0 size' => [0, 0],
            'negative size' => [-23, 4],
            'basic usage' => [23, 23],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetCurveThrowsException()
    {
        $this->config->withCurve(new StdClass());
    }

    /**
     * @dataProvider providerSetWidth
     */
    public function testSetWidth($size, $expected)
    {
        $this->assertSame($expected, $this->config->withWidth($size)->getWidth());
    }

    public function providerSetWidth()
    {
        return [
            '0 size' => [0, 3],
            'negative size' => [-23, 3],
            'basic usage' => [23, 23],
        ];
    }

    /**
     * @dataProvider providerWithReverse
     */
    public function testWithOpposite($size, $expected)
    {
        $this->assertSame($expected, $this->config->withOpposite($size)->isOpposite());
    }

    /**
     * @dataProvider providerWithReverse
     */
    public function testWithReverse($size, $expected)
    {
        $this->assertSame($expected, $this->config->withReverse($size)->isReverse());
    }

    public function providerWithReverse()
    {
        return [
            [true, true],
            [false, false],
            [1, true],
        ];
    }

    /**
     * @dataProvider providerChars
     */
    public function testWithSkin($char, $expected)
    {
        $this->assertSame($expected, $this->config->withSkin($char)->getSkin());
    }

    /**
     * @dataProvider providerChars
     */
    public function testWithHeadBlock($char, $expected)
    {
        $this->assertSame($expected, $this->config->withHead($char)->getHead());
    }

    public function providerChars()
    {
        return [
            ['#', '#'],
            ["\t", "\t"],
            ['€', '€'],
            ['█', '█'],
            [' ', ' '],
            ['\uD83D\uDE00', '😀'],
        ];
    }

    public function providerInvalidChars()
    {
        return [
            [[]],
            ['coucou'],
            [1],
            ['\uD83D\uDE00\uD83D\uDE00'],
        ];
    }

    /**
     * @dataProvider providerInvalidChars
     * @expectedException InvalidArgumentException
     */
    public function testWithHeadBlockThrowsInvalidArgumentException($input)
    {
        $this->config->withHead($input);
    }

    /**
     * @dataProvider providerInvalidChars
     * @expectedException InvalidArgumentException
     */
    public function testWithSkinThrowsInvalidArgumentException($input)
    {
        $this->config->withSkin($input);
    }
}

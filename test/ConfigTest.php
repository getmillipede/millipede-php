<?php

namespace Millipede\Test;

use Millipede\Config;
use PHPUnit_Framework_TestCase as TestCase;
use StdClass;

class ConfigTest extends TestCase
{
    private $config;

    public function setUp()
    {
        $this->config = new Config();
    }

    public function testNewInstance()
    {
        $this->assertSame('', $this->config->getComment());
        $this->assertSame(20, $this->config->getSize());
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
        $newComment = $this->config->withComment($comment)->getComment();
        $this->assertSame($expected, $newComment);
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
}

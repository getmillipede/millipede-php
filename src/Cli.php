<?php

namespace Millipede;

/**
 * A class to generate a Millipede in PHP
 */
final class Cli
{
    /**
     * POSIX color
     *
     * @var array
     */
    protected static $colorList = ['white', 'red', 'yellow', 'green', 'cyan', 'blue', 'magenta'];

    protected $colorOffsets = [];

    /**
     * Create a Cli Renderer to Display the millipede in Rainbow
     *
     * @return self
     */
    public static function createFromRandom()
    {
        return new self(self::$colorList[array_rand(self::$colorList)]);
    }

    /**
     * Create a Cli Renderer to Display the millipede in Rainbow
     *
     * @return self
     */
    public static function createFromRainbow()
    {
        return new self(self::$colorList);
    }

    /**
     * a new instance
     *
     * @param mixed $colorIndex a string of an array of string representing the millipede color
     */
    public function __construct($colorIndex = '')
    {
        if (is_string($colorIndex)) {
            $colorIndex = [$colorIndex];
        }

        $colorIndex = array_filter(
            array_map('strtolower', $colorIndex),
            function ($value) {
                return in_array($value, static::$colorList);
            }
        );

        if (empty($colorIndex)) {
            $colorIndex = ['white'];
        }

        $this->colorOffsets = $colorIndex;
    }

    /**
     * Modifier the renderer outbut
     *
     * @param Renderer $renderer
     *
     * @return \Generator
     */
    public function __invoke(Renderer $renderer)
    {
        foreach ($renderer as $key => $part) {
            $color = $this->colorOffsets[$key % count($this->colorOffsets)];
            yield $this->outln("<<$color>>$part<<reset>>");
        }
    }

    /**
     * Format the text output
     * Inspired by Aura\Cli\Stdio\Formatter (https://github.com/auraphp/Aura.Cli)
     *
     * @param string $str
     *
     * @return string
     */
    public static function outln($str)
    {
        return static::out($str).PHP_EOL;
    }

    /**
     * Format the text output
     * Inspired by Aura\Cli\Stdio\Formatter (https://github.com/auraphp/Aura.Cli)
     *
     * @param string $str
     *
     * @return string
     */
    public static function out($str)
    {
        static $formatter;
        static $func;
        static $regex;
        static $codes = [
            'reset'      => '0',
            'bold'       => '1',
            'dim'        => '2',
            'underscore' => '4',
            'blink'      => '5',
            'reverse'    => '7',
            'hidden'     => '8',
            'black'      => '30',
            'red'        => '31',
            'green'      => '32',
            'yellow'     => '33',
            'blue'       => '34',
            'magenta'    => '35',
            'cyan'       => '36',
            'white'      => '37',
            'blackbg'    => '40',
            'redbg'      => '41',
            'greenbg'    => '42',
            'yellowbg'   => '43',
            'bluebg'     => '44',
            'magentabg'  => '45',
            'cyanbg'     => '46',
            'whitebg'    => '47',
        ];

        if (null !== $regex) {
            return ' '.$func($regex, $formatter, $str);
        }

        $regex = ',<<\s*((('.implode('|', array_keys($codes)).')(\s*))+)>>,Umsi';
        $formatter = '';
        $func = 'preg_replace';
        if (false === strpos(strtolower(PHP_OS), 'win')) {
            $formatter = function (array $matches) use ($codes) {
                $str = preg_replace('/(\s+)/msi', ';', $matches[1]);

                return chr(27).'['.strtr($str, $codes).'m';
            };
            $func = 'preg_replace_callback';
        }

        return ' '.$func($regex, $formatter, $str);
    }
}

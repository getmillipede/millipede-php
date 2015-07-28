#!/usr/bin/env php
<?php

if (PHP_SAPI !== 'cli') {
    echo 'This script should be invoked via the CLI version of PHP, not the '.PHP_SAPI.' SAPI'.PHP_EOL;
    die(52);
}

function millipede($size)
{
    $size = filter_var($size, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'default' => 20]]);
    $paddingOffsets = ['  ', ' ', '', ' ', '  ', '   ', '    ', '   '];
    $milli = ['    ╚⊙ ⊙╝'];
    $i = 0;
    do {
        $milli[] = $paddingOffsets[++$i % 8] . '╚═(███)═╝';
    } while ($i < $size);

    return PHP_EOL.implode(PHP_EOL, $milli).PHP_EOL;
}

$size = isset($argv[1]) ? $argv[1] : 20;
echo millipede($size);
die(0);
